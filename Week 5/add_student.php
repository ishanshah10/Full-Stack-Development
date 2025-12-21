<?php
require 'header.php';
require 'functions.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST["name"] ?? "");
        $email = $_POST["email"] ?? "";
        $skillsString = $_POST["skills"] ?? "";

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format");
        }

        $skillsArray = cleanSkills($skillsString);

        saveStudent($name, $email, $skillsArray);
        $success = "Student info saved successfully!";
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}
?>

<h2>Add Student Info</h2>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
<?php foreach ($errors as $error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Skills (comma-separated):</label>
    <input type="text" name="skills" required><br>

    <button type="submit">Save</button>
</form>

<?php
require 'footer.php';
?>