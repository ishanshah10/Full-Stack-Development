<?php
include("../config/db.php");

$id = $_POST['id'];
$newStock = $_POST['stock'];

$stmt = $conn->prepare("UPDATE products SET stock=? WHERE id=?");
$stmt->bind_param("ii", $newStock, $id);
$stmt->execute();

echo $newStock;
