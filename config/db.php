<?php
// إعداد بيانات الاتصال بقاعدة البيانات
$host = "localhost";  // اسم المستضيف (غالبًا localhost)
$dbname = "PHP";      // اسم قاعدة البيانات
$username = "root";   // اسم المستخدم
$password = "";       // كلمة المرور (فارغة في XAMPP و MAMP)

try {
    // إنشاء اتصال باستخدام PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // ضبط وضع الأخطاء ليتم التبليغ عنها كاستثناءات
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // في حالة فشل الاتصال، يتم عرض رسالة خطأ مع إنهاء التنفيذ
    die("❌ Connection failed: " . $e->getMessage());
}
?>
