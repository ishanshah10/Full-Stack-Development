<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
}
table {
    border-collapse: collapse;
    width: 70%;
    margin-top: 20px;
}
th, td {
    padding: 10px;
    text-align: left;
}
a {
    text-decoration: none;
    color: blue;
    font-size: 20px;
    font-weight: semi-bold;
}</style>
<body>
    <h2>Student List</h2>
    <a href="add.php">Add New Student</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['course']) ?></td>
            <td>
                <a href="edit.php?id=<?= $student['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>