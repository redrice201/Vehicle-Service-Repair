<?php
session_start();
include "../db.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status"=>"error","message"=>"Invalid request"]);
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

$stmt = $conn->prepare("SELECT id, full_name, email, password, is_admin FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status"=>"error","message"=>"Email not found"]);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user["password"])) {
    echo json_encode(["status"=>"error","message"=>"Incorrect password"]);
    exit;
}

$_SESSION["user"] = [
    "id" => $user["id"],
    "name" => $user["full_name"],
    "email" => $user["email"],
    "is_admin" => $user["is_admin"]
];

echo json_encode([
    "status" => "success",
    "message" => "Login successful!",
    "is_admin" => $user["is_admin"]
]);
exit;
?>
