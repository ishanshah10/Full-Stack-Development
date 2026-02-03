<?php
include("../public/auth.php");
include("../config/db.php");
include("../includes/functions.php");
include("../includes/header.php");

$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<h2>Search Products</h2>

<div class="search-box">

    <label>Product Name:</label>
    <input type="text" id="nameSearch" placeholder="Type product name...">

    <label>Supplier:</label>
    <select id="supplierSearch">
        <option value="">-- Supplier --</option>
        <?php while($s = $suppliers->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= e($s['name']) ?></option>
        <?php endwhile; ?>
    </select>

    <label>Min Price:</label>
    <input type="number" step="0.01" id="minPrice" placeholder="Min Price">

    <label>Max Stock:</label>
    <input type="number" id="maxStock" placeholder="Max Stock">

</div>

<div id="resultArea"></div>

<script src="../assets/js/script.js"></script>

<?php include("../includes/footer.php"); ?>
