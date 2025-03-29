<?php
session_start();
// Include the database connection file
require_once 'config/db.php';

// Check if the user is logged in
if(empty($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

// Get the logged-in user's username
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="php-logo.png" alt="php" width="100">
        <div class="login-a">
            <a href="profile.php">Welcome, <?php echo htmlspecialchars($username); ?>!</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="form">
        <h2>Welcome to your Dashboard!</h2>
        <p>Hello, <strong><?php echo htmlspecialchars($username); ?></strong>. You are now logged in.</p>
        <p>Explore our website and enjoy our services!</p>
        <a href="https://github.com/altoidman">Go to my github!</a>
    </div>

    <footer>
        <p>&copy; 2025 Your Company</p>
    </footer>

</body>
</html>
