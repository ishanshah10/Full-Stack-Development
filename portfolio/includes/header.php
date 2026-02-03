<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <script src="../assets/js/script.js"></script>

</head>
<body>

<h1>Inventory & Stock Tracking System</h1>

<nav class="navbar">
    <a href="index.php">Home</a>
    <a href="add.php">Add Product</a>
    <a href="add_supplier.php">Add Supplier</a>
    <a href="search.php">Search</a>

   <?php if(isset($_SESSION['user'])): ?>

    <span class="user">
        Logged in as: <?= $_SESSION['user'] ?> (<?= $_SESSION['role'] ?>)
    </span>

    <a href="logout.php" class="logout">Logout</a>

<?php endif; ?>


</nav>

<hr>
