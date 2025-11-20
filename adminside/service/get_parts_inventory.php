<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../db.php";  

header('Content-Type: application/json');

$sql = "SELECT id, part_name, quantity FROM parts_inventory ORDER BY part_name ASC";
$result = $conn->query($sql);

$parts = [];
while ($row = $result->fetch_assoc()) {
    $parts[] = [
        'id' => $row['id'],
        'part_name' => $row['part_name'],
        'quantity' => (int)$row['quantity']
    ];
}

echo json_encode($parts);
exit;
