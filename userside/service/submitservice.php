<?php
session_start();
include "../db.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(["status" => "error", "message" => "You must be logged in to book a service."]);
    exit;
}

$user_id = $_SESSION['user']['id'];

$vehicle_model = trim($_POST['vehicle_model'] ?? '');
$plate_number = trim($_POST['plate_number'] ?? '');
$problem = trim($_POST['problem'] ?? '');
$other_problem = trim($_POST['other_problem'] ?? '');
$details = trim($_POST['details'] ?? '');
$delivery_date = trim($_POST['delivery_date'] ?? '');

if (!$vehicle_model || !$plate_number || !$problem || !$delivery_date) {
    echo json_encode(["status" => "error", "message" => "Please fill in all required fields."]);
    exit;
}

$problem_description = ($problem === "Others" && $other_problem) ? $other_problem : $problem;

$stmt = $conn->prepare("INSERT INTO service_orders (user_id, vehicle_model, plate_number, problem, details, delivery_date, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())");
$stmt->bind_param("isssss", $user_id, $vehicle_model, $plate_number, $problem_description, $details, $delivery_date);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Service request submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error submitting service request: " . $stmt->error]);
}
?>
