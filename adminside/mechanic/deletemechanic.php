<?php
include "../db.php";

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM mechanics WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['message'] = "Mechanic deleted successfully!";
header("Location: ../addmechanic.php");
exit;
?>
