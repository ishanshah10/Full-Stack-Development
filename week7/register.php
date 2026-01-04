<!DOCTYPE html>
<html>
<head>
    <title>Register - Student Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2>
        <form method="POST">
            <input type="number" name="student_id" placeholder="Student ID" required><br>
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p style="margin-top:15px;">Already registered? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>