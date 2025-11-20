<?php
session_start();
include "../db.php";

$id = $_POST['delete_id'];

$sql = "DELETE FROM parts_inventory WHERE id=$id";

if ($conn->query($sql)) {
    $_SESSION['message'] = "Part deleted successfully!";
} else {
    $_SESSION['message'] = "Error deleting part.";
}

header("Location: ../parts.php");
exit();
?>
