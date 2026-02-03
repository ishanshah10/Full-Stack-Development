<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $stmt = $conn->prepare("
        SELECT * FROM users 
        WHERE username=? AND password=? AND role=?
    ");

    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        header("Location: index.php");

    } else {
        $error = "Invalid Username, Password or Role Selection";
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="login-container">

    <h2>Inventory System Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">

        <input name="username" placeholder="Username" required>

        <input name="password" type="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Login Type</option>
            <option value="admin">Login as Admin</option>
            <option value="user">Login as User</option>
        </select>

        <button class="login-btn">Login</button>

    </form>

</div>

</div>
