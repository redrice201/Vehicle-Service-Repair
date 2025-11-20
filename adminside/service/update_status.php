<?php
session_start();
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['next_status']; 
    $mechanic_id = isset($_POST['mechanic_id']) && $_POST['mechanic_id'] != '' ? $_POST['mechanic_id'] : null;
    $price = isset($_POST['price']) && $_POST['price'] != '' ? $_POST['price'] : null;

    $fields = "status = ?";
    $params = [$status];
    $types = "s";

    if ($mechanic_id) {
        $fields .= ", assignmechanic = ?";
        $params[] = $mechanic_id;
        $types .= "i";
    }

    if ($status === 'Completed' && $price !== null) {
        $fields .= ", price = ?";
        $params[] = $price;
        $types .= "d";
    }

    $sql = "UPDATE service_orders SET $fields WHERE id = ?";
    $params[] = $order_id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->close();

    if (isset($_POST['parts']) && is_array($_POST['parts'])) {
        $parts = $_POST['parts'];           
        $quantities = $_POST['quantity'];  

        foreach ($parts as $part_id) {
            $qty_used = (int)$quantities[$part_id];

            $stmt = $conn->prepare("UPDATE parts_inventory SET quantity = quantity - ? WHERE id = ?");
            $stmt->bind_param("ii", $qty_used, $part_id);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO order_parts (order_id, part_id, quantity_used) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $order_id, $part_id, $qty_used);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conn->close();

    $_SESSION['message'] = "Order status updated to $status successfully!";
    header("Location: ../customer.php");
    exit;
}
?>
