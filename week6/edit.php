<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $update = $pdo->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
    $update->execute([$name, $email, $course, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
    <h2>Edit Student</h2>
    <form method="post">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required><br><br>
        Course: <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>