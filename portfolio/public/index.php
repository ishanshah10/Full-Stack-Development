<?php
include("../public/auth.php");
include("../config/db.php");
include("../includes/functions.php");
include("../includes/header.php");

$currentUserId = $_SESSION['user_id'];
$currentRole = $_SESSION['role'];

$result = $conn->query("
    SELECT products.*, suppliers.name AS supplier 
    FROM products 
    LEFT JOIN suppliers ON products.supplier_id = suppliers.id
");
?>

<table>
<tr>
    <th>Name</th>
    <th>Supplier</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Alert</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= e($row['product_name']) ?></td>
    <td><?= e($row['supplier']) ?></td>
    <td>NPR.<?= e($row['price']) ?></td>
    <td>
        <button class="btn-minus" onclick="updateStock(<?= $row['id'] ?>, -1)">-</button>
        <span id="stock-<?= $row['id'] ?>"><?= $row['stock'] ?></span>
        <button class="btn-plus" onclick="updateStock(<?= $row['id'] ?>, 1)">+</button>
    </td>
    <td>
        <?php if($row['stock'] < 10): ?>
            <span class="alert">Low Stock</span>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($currentRole === 'admin' || $row['added_by'] == $currentUserId): ?>
            <a class="btn-edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a class="btn-delete" href="delete.php?id=<?= $row['id'] ?>" 
               onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
        <?php else: ?>
            <span class="locked">🔒 Admin Product</span>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include("../includes/footer.php"); ?>