<?php
require_once 'config/db.php'; // استدعاء ملف الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // دالة لتنظيف المدخلات من أي رموز ضارة
    function clear($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    // استلام البيانات من النموذج
    $username = clear($_POST['username']);
    $password = $_POST['password']; // لا حاجة لتنظيفها لأننا سنستخدم `password_hash()`
    $confirm  = $_POST['confirm'];

    // التحقق مما إذا كان اسم المستخدم موجودًا بالفعل
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    // مصفوفة لتخزين الأخطاء
    $errors = [];

    if ($result > 0) {
        $errors[] = "❌ This username is already registered.";
    }

    if ($password !== $confirm) {
        $errors[] = "❌ Passwords do not match.";
    }

    // في حالة عدم وجود أخطاء، يتم إنشاء الحساب
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // إدخال بيانات المستخدم إلى قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO users (username, password, created) VALUES (:username, :password, :created)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":created", date('Y-m-d H:i:s'));
        $stmt->execute();

        // إعادة التوجيه إلى صفحة تسجيل الدخول
        header("Location: login.php");
        exit; // إنهاء التنفيذ بعد التوجيه
    }

    // إغلاق الاتصال بقاعدة البيانات
    $stmt = null;
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="php-logo.png" alt="PHP" width="100">
        <div class="login-a">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </header>

    <div class="form">
        <form method="post">
            <h2 style="margin-bottom:8px;">Register | Users</h2>
            <hr style="margin-bottom:8px;">

            <?php
            // عرض الأخطاء إن وجدت
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color:yellow; padding:4px 6px; background:#f64f4f;'>$error</p>";
                }
            }
            ?>

            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" placeholder="Username" required><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password" required><br>

            <label for="confirm">Confirm Password</label><br>
            <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required><br>

            <p style="margin-bottom:10px;">
                <a href="login.php">Already have an account?</a>
            </p>

            <center>
                <button type="submit">Register</button>
            </center>
        </form>
    </div>

    <footer>
        <p>&copy; copyright! 2025</p>
    </footer>
</body>
</html>
