<?php
// Simple header layout
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Portfolio Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f9fafb; 
    color: #1f2937;      
}

header, footer {
    background: #e5e7eb; 
    padding: 15px 20px;
}

header a {
    color: #2563eb; 
    margin-right: 12px;
    text-decoration: none;
}

header a:hover {
    text-decoration: underline;
}

main {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav li {
    margin: 8px 0;
}

.success {
    color: #16a34a; 
}

.error {
    color: #dc2626; 
}

form {
    display: grid;
    gap: 10px;
    max-width: 500px;
    background: #ffffff; 
    padding: 20px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
}

input[type="text"],
input[type="email"],
input[type="file"] {
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    color: #1f2937;
}

button {
    padding: 10px;
    border: none;
    border-radius: 6px;
    background: #3b82f6; 
    color: white;
    cursor: pointer;
}

button:hover {
    background: #2563eb;
}

.students {
    list-style: none;
    padding: 0;
}

.student {
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    margin-bottom: 10px;
    background: #ffffff;
}
    </style>
</head>
<body>
<header>
    <strong>Student Portfolio Manager</strong>
    <nav style="margin-top:8px;">
        <a href="index.php">Home</a>
        <a href="add_student.php">Add Student Info</a>
        <a href="upload.php">Upload Portfolio</a>
        <a href="students.php">View Students</a>
    </nav>
</header>