<?php
include("../public/auth.php");
include("../config/db.php");
include("../includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("
        INSERT INTO suppliers (name, email, phone, location)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("ssss", $name, $email, $phone, $location);
    $stmt->execute();

    }
?>

<h2>Add Supplier</h2>

<form method="post">

    <input type="text" name="name" placeholder="Supplier Name" required>

    <input type="email" name="email" placeholder="Email Address" required>

    <input type="text" name="phone" placeholder="Phone Number" required>

    <input type="text" name="location" placeholder="Location" required>

    <button>Add Supplier</button>

</form>

<hr>

<h3>All Suppliers</h3>

<table>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Location</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM suppliers");

while ($row = $result->fetch_assoc()):
?>

<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['location'] ?></td>
</tr>

<?php endwhile; ?>

</table>

<?php include("../includes/footer.php"); ?>
