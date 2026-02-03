<?php
include("../public/auth.php");
include("../config/db.php");
include("../includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['name'];
    $supplierId = $_POST['supplier_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $addedBy = $_SESSION['user_id']; // capture who added it

    $stmt = $conn->prepare("
        INSERT INTO products (product_name, supplier_id, price, stock, added_by)
        VALUES (?,?,?,?,?)
    ");
    $stmt->bind_param("sidii", $product, $supplierId, $price, $stock, $addedBy);
    $stmt->execute();

    header("Location: index.php");
}
?>

<h2>Add Product</h2>

<form method="post">

    <input type="text" name="name" placeholder="Product Name" required>

    <label>Supplier:</label>

    <select name="supplier_id" required>
        <option value="">Select Supplier</option>

        <?php
        $suppliers = $conn->query("SELECT * FROM suppliers");
        while ($s = $suppliers->fetch_assoc()):
        ?>
            <option value="<?= $s['id'] ?>">
                <?= $s['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <input type="number" step="0.01" name="price" placeholder="Price" required>

    <input type="number" name="stock" placeholder="Stock" required>

    <button>Add Product</button>

</form>

<?php include("../includes/footer.php"); ?>
