<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : "light";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: <?= $theme == "dark" ? "black" : "#f0f2f5" ?>;
            color: <?= $theme == "dark" ? "white" : "black" ?>;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Student <?= $_SESSION['student_id']; ?>!</h2>
        <nav>
            <a href="preference.php">Change Theme</a> |
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>