<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = $_POST['theme'];
    // overwrite cookie with new value
    setcookie("theme", $theme, time() + (86400 * 30), "/"); 
    // reload immediately so new theme applies
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Preferences</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Theme Preference</h2>
        <form method="POST">
            <select name="theme">
                <option value="light">Light Mode</option>
                <option value="dark">Dark Mode</option>
            </select><br>
            <button type="submit">Save Preference</button>
        </form>
        <p style="margin-top:15px;"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>