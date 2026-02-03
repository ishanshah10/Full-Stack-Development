<?php
include("../config/db.php");

$name = $_POST['name'];
$supplier = $_POST['supplier'];
$min_price = $_POST['min_price'];
$max_stock = $_POST['max_stock'];

$query = "
SELECT products.*, suppliers.name AS supplier
FROM products
LEFT JOIN suppliers ON products.supplier_id = suppliers.id
WHERE 1=1
";

if (!empty($name)) {
    $query .= " AND products.product_name LIKE '%$name%'";
}

if (!empty($supplier)) {
    $query .= " AND suppliers.id = '$supplier'";
}

if (!empty($min_price)) {
    $query .= " AND price >= '$min_price'";
}

if (!empty($max_stock)) {
    $query .= " AND stock <= '$max_stock'";
}

$result = $conn->query($query);

echo "<table>
<tr>
<th>Product</th>
<th>Supplier</th>
<th>Price</th>
<th>Stock</th>
</tr>";

while ($row = $result->fetch_assoc()) {

    echo "<tr>
        <td>{$row['product_name']}</td>
        <td>{$row['supplier']}</td>
        <td>NPR {$row['price']}</td>
        <td>{$row['stock']}</td>
    </tr>";
}

echo "</table>";
?>
