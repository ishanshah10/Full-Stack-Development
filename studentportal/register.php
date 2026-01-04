<?php
include "db.php";

if (isset($_POST['register'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $name, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Student ID already exists!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="light">
<div class="container">
    <h2>Student Registration</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button>
        <p>Already registered? <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>
