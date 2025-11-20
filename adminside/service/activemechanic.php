<?php
include "../db.php"; 

$mechanics = [];
$result = $conn->query("SELECT * FROM mechanics WHERE status='Active' ORDER BY full_name ASC");
while($row = $result->fetch_assoc()){
    $mechanics[] = $row;
}

header('Content-Type: application/json');
echo json_encode($mechanics);
