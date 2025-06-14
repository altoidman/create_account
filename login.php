<?php
// بدء الجلسة لتتبع حالة تسجيل الدخول
session_start();

// استدعاء ملف الاتصال بقاعدة البيانات
require_once 'config/db.php';

// التحقق مما إذا تم إرسال البيانات عبر نموذج POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // دالة لتنظيف المدخلات لمنع هجمات XSS و SQL Injection
    function clear($input){
        $input = trim($input); // إزالة الفراغات الزائدة
        $input = stripslashes($input); // إزالة الخطوط المائلة العكسية
        $input = htmlspecialchars($input); // تحويل الأحرف الخاصة إلى كود HTML
        return $input;
    }

    // استقبال بيانات المستخدم بعد تنقيتها
    $username = clear($_POST['username']);
    $password = $_POST['password']; // لا يتم تنظيف كلمة المرور لأننا نحتاجها كما هي للتحقق من التجزئة

    // إعداد الاستعلام للتحقق مما إذا كان المستخدم موجودًا في قاعدة البيانات
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    
    // جلب بيانات المستخدم إذا كان موجودًا
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // التحقق مما إذا كان المستخدم موجودًا وكلمة المرور صحيحة
    if ($result && password_verify($password, $result['password'])) {
        // تسجيل المستخدم في الجلسة
        $_SESSION['username'] = $username;
        
        // إعادة التوجيه إلى الصفحة الرئيسية
        header("Location: index.php");
        exit;
    } else {
        // في حالة فشل تسجيل الدخول، يتم عرض رسالة خطأ
        $error = "<p style='color:yellow; padding:4px 6px; background:#f64f4f;'>Username or password is incorrect!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="php-logo.png" alt="php" width="100">
        <div class="login-a">
            <a href="login.php">Login</a><a href="register.php">Register</a>
        </div>
    </header>

    <div class="form">
        <form method="post">
            <h2 style="margin-bottom:8px;">Login | Users</h2>
            <hr style="margin-bottom:8px;">
            
            <!-- عرض رسالة الخطأ إن وجدت -->
            <?php echo $error ?? ""; ?>
        
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" placeholder="Username" required><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password" required><br>
            
            <p style="margin-bottom:10px;"><a href="register.php">Do you want to create a new account?</a></p>
            
            <center>
                <button type="submit">Login</button>
            </center>
        </form>
    </div>

    <footer>
        <p>&copy; copyright 2025!</p>
    </footer>
</body>
</html>
