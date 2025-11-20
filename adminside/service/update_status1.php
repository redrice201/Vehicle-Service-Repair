<?php

$order_id = $_POST['order_id'];
$next_status = $_POST['next_status'];
$mechanic_id = $_POST['mechanic_id'] ?? null;

$parts = $_POST['parts'] ?? []; 
$quantities = $_POST['quantity'] ?? []; 
foreach ($parts as $part_id) {
    $qty = $quantities[$part_id];
    $conn->query("UPDATE parts_inventory SET quantity = quantity - $qty WHERE id = $part_id");
  
}

?>