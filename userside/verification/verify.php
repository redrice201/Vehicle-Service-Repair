<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../db.php';
header('Content-Type: application/json');

try {
    $email = $_POST['email'] ?? '';
    $code  = $_POST['verification_code'] ?? '';
    $user  = $_SESSION['pending_user'] ?? null;

    if (!$user) {
        echo json_encode(['status'=>'error','message'=>'No pending registration found']);
        exit;
    }

    if (!isset($user['verification_code'])) {
        echo json_encode(['status'=>'error','message'=>'No verification code set']);
        exit;
    }

    if ($user['email'] !== $email || $user['verification_code'] != $code) {
        echo json_encode(['status'=>'error','message'=>'Invalid verification code!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (full_name,email,phone,address,password) VALUES (?,?,?,?,?)");
    if (!$stmt) throw new Exception($conn->error);

    $stmt->bind_param("sssss", $user['full_name'], $user['email'], $user['contact'], $user['address'], $user['password']);
    if (!$stmt->execute()) throw new Exception($stmt->error);

    unset($_SESSION['pending_user']);
    echo json_encode(['status'=>'success','message'=>'Account verified and registration complete!']);
} catch (Exception $e) {
    echo json_encode(['status'=>'error','message'=>'Server Error: '.$e->getMessage()]);
}
