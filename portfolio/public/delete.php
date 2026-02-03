<?php
include("../public/auth.php");
include("../config/db.php");

$id = $_GET['id'];
$currentUserId = $_SESSION['user_id'];
$currentRole = $_SESSION['role'];

// Find who added the product
$stmt = $conn->prepare("SELECT added_by FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($product) {
    // Allow if admin OR if the product was added by this user
    if ($currentRole === 'admin' || $product['added_by'] == $currentUserId) {
        $deleteStmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $deleteStmt->bind_param("i", $id);
        $deleteStmt->execute();
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Only admins can delete products added by admins.'); window.location='index.php';</script>";
    }
}
?>