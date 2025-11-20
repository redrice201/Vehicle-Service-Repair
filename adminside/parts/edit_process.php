<?php
session_start();
include "../db.php";

$id = $_POST['id'];
$part_name = $_POST['part_name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];

$sql = "UPDATE parts_inventory SET 
        part_name='$part_name',
        category='$category',
        quantity='$quantity',
        unit_price='$unit_price'
        WHERE id=$id";

if ($conn->query($sql)) {
    $_SESSION['message'] = "Part updated successfully!";
} else {
    $_SESSION['message'] = "Error updating part.";
}

header("Location: ../parts.php");
exit();
?>
