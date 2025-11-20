<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status'=>'error','message'=>'Invalid request']);
    exit;
}

$email = $_POST['email'] ?? '';
$code  = $_POST['verification_code'] ?? ''; 

if (!isset($_SESSION['password_reset'])) {
    echo json_encode(['status'=>'error','message'=>'No reset session found']);
    exit;
}

$session = $_SESSION['password_reset'];

if ($session['email'] !== $email) {
    echo json_encode(['status'=>'error','message'=>'Email does not match session'] );
    exit;
}

if ($session['reset_code'] != $code) {
    echo json_encode(['status'=>'error','message'=>'Invalid verification code']);
    exit;
}

// Code is correct
echo json_encode(['status'=>'success','message'=>'Code verified! You can now change your password.']);

