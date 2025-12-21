<?php
require 'header.php';
require 'functions.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $success = uploadPortfolioFile($_FILES["portfolio"]);
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
<?php foreach ($errors as $error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="portfolio" required>
    <button type="submit">Upload</button>
</form>

<?php
require 'footer.php';
?>