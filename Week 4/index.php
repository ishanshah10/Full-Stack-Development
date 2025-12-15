<?php

$name = $email = "";
$errors = [];
$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data safely
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    

    
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

   
    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

  
    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters";
    } elseif (!preg_match("/[@$!%*?&]/", $password)) {
        $errors["password"] = "Password must contain at least one special character (@ $ ! % * ? &)";
    }

    if ($password !== $confirmPassword) {
        $errors["confirm_password"] = "Passwords do not match";
    }


    if (empty($errors)) {

        $file = "users.json";

        if (!file_exists($file)) {
            $errors["file"] = "User data file not found.";
        } else {

            
            $jsonData = file_get_contents($file);
            if ($jsonData === false) {
                $errors["file"] = "Failed to read user data.";
            } else {

                $users = json_decode($jsonData, true);
                if (!is_array($users)) {
                    $errors["file"] = "Invalid JSON format.";
                } else {

                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $newUser = [
                        "name" => $name,
                        "email" => $email,
                        "password" => $hashedPassword
                    ];

                    $users[] = $newUser;

                    $updatedJson = json_encode($users, JSON_PRETTY_PRINT);

                    if (file_put_contents($file, $updatedJson) === false) {
                        $errors["file"] = "Failed to save user data.";
                    } else {
                        $successMessage = "Registration successful!";
                        $name = $email = "";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial; background: black; }
        form { background: white; padding: 20px; width: 400px; margin: 50px auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        .error { color: red; font-size: 14px; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        button { margin-top: 15px; padding: 10px; width: 100%; }
    </style>
</head>
<body>

<form method="POST">
    <h2>User Registration</h2>

    <?php if ($successMessage): ?>
        <div class="success"><?= $successMessage ?></div>
    <?php endif; ?>

    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <div class="error"><?= $errors["name"] ?? "" ?></div>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
    <div class="error"><?= $errors["email"] ?? "" ?></div>

    <label>Password</label>
    <input type="password" name="password">
    <div class="error"><?= $errors["password"] ?? "" ?></div>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password">
    <div class="error"><?= $errors["confirm_password"] ?? "" ?></div>

    <div class="error"><?= $errors["file"] ?? "" ?></div>

    <button type="submit">Register</button>
</form>

</body>
</html>
