<?php
session_start();
include "../db.php";

header('Content-Type: application/json');

if (!isset($_SESSION["user"])) {
    echo json_encode(['status'=>'error','message'=>'Not logged in']);
    exit;
}

$user_id = $_SESSION["user"]["id"];

$full_name = $_POST["full_name"] ?? '';
$email     = $_POST["email"] ?? '';
$phone     = $_POST["phone"] ?? '';
$address   = $_POST["address"] ?? '';

// Password fields
$current_password = $_POST["current_password"] ?? '';
$new_password     = $_POST["new_password"] ?? '';
$confirm_password = $_POST["confirm_password"] ?? '';

$message = "";

if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if (!password_verify($current_password, $res["password"])) {
        echo json_encode(['status'=>'error','message'=>'Current password is incorrect.']);
        exit;
    }
    if ($new_password !== $confirm_password) {
        echo json_encode(['status'=>'error','message'=>'New passwords do not match.']);
        exit;
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=?, password=? WHERE id=?");
    $stmt->bind_param("sssssi", $full_name, $email, $phone, $address, $hashed_password, $user_id);
} else {
    $stmt = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $user_id);
}

if ($stmt->execute()) {
    $_SESSION["user"]["name"] = $full_name;
    $_SESSION["user"]["email"] = $email;
    echo json_encode(['status'=>'success','message'=>'Profile updated successfully!']);
} else {
    echo json_encode(['status'=>'error','message'=>'Database error: '.$stmt->error]);
}
?>
