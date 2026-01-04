<?php
session_start();
include 'db.php'; // include database connection

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password   = $_POST['password'];

    // Prepared statement to fetch hashed password
    $stmt = $conn->prepare("SELECT password FROM students WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $stmt->bind_result($storedhash);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if ($storedhash && password_verify($password, $storedhash)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['student_id'] = $student_id;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Student ID or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Student Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Student Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="number" name="student_id" placeholder="Student ID" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p style="margin-top:15px;">New user? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>