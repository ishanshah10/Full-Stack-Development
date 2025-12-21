<?php
require 'header.php';

$students = file("students.txt", FILE_IGNORE_NEW_LINES);

echo "<h2>Registered Students</h2>";
foreach ($students as $student) {
    $data = explode("|", $student); // stored as name|email|skill1,skill2
    echo "<p><strong>Name:</strong> {$data[0]}<br>";
    echo "<strong>Email:</strong> {$data[1]}<br>";
    echo "<strong>Skills:</strong> " . implode(", ", explode(",", $data[2])) . "</p>";
}

require 'footer.php';
?>