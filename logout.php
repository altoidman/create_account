<?php
    // بدء الجلسة
    session_start();
if(isset($_SESSION['username'])){

    // إنهاء الجلسة
    session_destroy();

    // إعادة التوجيه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit; // إنهاء التنفيذ بعد التوجيه
} else {
    // إذا لم يكن المستخدم مسجلاً الدخول، إعادة التوجيه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit;
}

?>