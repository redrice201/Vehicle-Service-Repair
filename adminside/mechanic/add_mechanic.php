<?php
session_start();
include "../db.php";

$full_name = $_POST['full_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$specialization = $_POST['specialization'] ?? '';
$status = $_POST['status'] ?? 'Active';

if (!$full_name || !$email) {
    $_SESSION['message'] = "Full Name and Email are required";
    header("Location: ../adminside/mechanics.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Invalid email format";
    header("Location: ../adminside/mechanics.php");
    exit;
}
$stmt = $conn->prepare("SELECT id FROM mechanics WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['message'] = "Email already exists";
    header("Location: ../addmechanic.php");
    exit;
}

$stmt = $conn->prepare("INSERT INTO mechanics (full_name,email,phone,specialization,status) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $full_name, $email, $phone, $specialization, $status);

if ($stmt->execute()) {
    $_SESSION['message'] = "Mechanic added successfully!";
} else {
    $_SESSION['message'] = "Database error: " . $stmt->error;
}

header("Location: ../addmechanic.php");
exit;
