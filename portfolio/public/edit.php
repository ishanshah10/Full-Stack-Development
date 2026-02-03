<?php
include("../public/auth.php");
include("../config/db.php");
include("../includes/functions.php");
include("../includes/header.php");

$id = $_GET['id'];
$currentUserId = $_SESSION['user_id'];
$currentRole = $_SESSION['role'];

$stmt = $conn->prepare("
    SELECT products.*, suppliers.name AS supplier_name 
    FROM products 
    LEFT JOIN suppliers ON products.supplier_id = suppliers.id 
    WHERE products.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// Restrict access: only admin OR the user who added it
if ($currentRole !== 'admin' && $product['added_by'] != $currentUserId) {
    echo "<script>alert('Only admins can edit products added by admins.'); window.location='index.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplierName = $_POST['supplier_name'];
    $supplierId = $product['supplier_id'];

    $updateSupplier = $conn->prepare("UPDATE suppliers SET name = ? WHERE id = ?");
    $updateSupplier->bind_param("si", $supplierName, $supplierId);
    $updateSupplier->execute();

    $updateProduct = $conn->prepare("UPDATE products SET product_name = ?, price = ?, stock = ? WHERE id = ?");
    $updateProduct->bind_param("sdii", $name, $price, $stock, $id);

    if ($updateProduct->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating product!";
    }
}
?>

<h2>Edit Product & Supplier</h2>

<form method="post">

    <label>Product Name</label>
    <input type="text" name="name" 
           value="<?= e($product['product_name']) ?>" required>

    <label>Supplier Name</label>
    <input type="text" name="supplier_name" 
           value="<?= e($product['supplier_name']) ?>" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price"
           value="<?= e($product['price']) ?>" required>

    <label>Stock</label>
    <input type="number" name="stock"
           value="<?= e($product['stock']) ?>" required>

    <button>Update All Details</button>

</form>

<?php include("../includes/footer.php"); ?>
