<?php
session_start();
include '../db.php';
header('Content-Type: application/json');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status'=>'error','message'=>'Invalid request']);
    exit;
}

$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (!isset($_SESSION['password_reset'])) {
    echo json_encode(['status'=>'error','message'=>'No password reset session found']);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(['status'=>'error','message'=>'Passwords do not match']);
    exit;
}

$email = $_SESSION['password_reset']['email'];

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
if (!$stmt) {
    echo json_encode(['status'=>'error','message'=>'Database prepare failed: '.$conn->error]);
    exit;
}

$stmt->bind_param("ss", $hashed_password, $email);

if ($stmt->execute()) {
    unset($_SESSION['password_reset']);
    echo json_encode(['status'=>'success','message'=>'Password successfully changed!']);
} else {
    echo json_encode(['status'=>'error','message'=>'Database error: '.$stmt->error]);
}
?>
