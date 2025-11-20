<?php
session_start();
include "../db.php";

$part_name = $_POST['part_name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];

$sql = "INSERT INTO parts_inventory (part_name, category, quantity, unit_price)
        VALUES ('$part_name', '$category', '$quantity', '$unit_price')";

if ($conn->query($sql)) {
    $_SESSION['message'] = "New part added successfully!";
} else {
    $_SESSION['message'] = "Error adding part.";
}

header("Location: ../parts.php");
exit();
?>
