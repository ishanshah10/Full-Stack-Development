<?php
include "../config/db.php";

$id = $_POST['id'];
$stock = $_POST['stock'];

if ($stock < 0) {
    echo "0";
    exit();
}

$sql = "UPDATE products SET stock = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $stock, $id);
$stmt->execute();

echo $stock;
?>
