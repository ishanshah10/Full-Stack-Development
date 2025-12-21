<?php
function formatName($name) {
    return ucwords(trim($name)); // Capitalize each word
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map('trim', $skills); // remove spaces
}

function saveStudent($name, $email, $skillsArray) {
    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . "\n";
    file_put_contents("students.txt", $line, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    if ($file["error"] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload error.");
    }

    $allowed = ["pdf", "jpg", "png"];
    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type. Only PDF, JPG, PNG allowed.");
    }

    if ($file["size"] > 2 * 1024 * 1024) {
        throw new Exception("File too large. Max 2MB.");
    }

    $newName = uniqid("portfolio_", true) . "." . $ext;
    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            throw new Exception("Failed to create upload directory.");
        }
    }

    $destination = $uploadDir . $newName;
    if (!move_uploaded_file($file["tmp_name"], $destination)) {
        throw new Exception("Failed to save uploaded file.");
    }

    return "File uploaded successfully as $newName";
}
?>