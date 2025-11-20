<?php
include "../db.php";

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$specialization = $_POST['specialization'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE mechanics SET full_name=?, email=?, phone=?, specialization=?, status=? WHERE id=?");
$stmt->bind_param("sssssi", $full_name, $email, $phone, $specialization, $status, $id);
$stmt->execute();

$_SESSION['message'] = "Mechanic updated successfully!";
header("Location: ../addmechanic.php");
exit;
?>
