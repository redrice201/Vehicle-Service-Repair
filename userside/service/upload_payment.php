<?php
include "../db.php"; 
session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    
    if (isset($_FILES['payment_screenshot']) && $_FILES['payment_screenshot']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['payment_screenshot']['tmp_name'];
        $fileName = $_FILES['payment_screenshot']['name'];
        $fileSize = $_FILES['payment_screenshot']['size'];
        $fileType = $_FILES['payment_screenshot']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

   $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExts)) {
            $newFileName = uniqid('payment_', true) . '.' . $fileExtension;
            $uploadFileDir = '../uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
            
                $stmt = $conn->prepare("UPDATE service_orders SET payment_img = ? WHERE id = ?");
                $stmt->bind_param("si", $newFileName, $order_id);
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Payment screenshot uploaded successfully!";
                } else {
                    $_SESSION['error'] = "Database error: Could not update record.";
                }
            } else {
                $_SESSION['error'] = "Error moving the uploaded file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, GIF allowed.";
        }
    } else {
        $_SESSION['error'] = "No file uploaded or upload error.";
    }
    
    header("Location: ../servicetracking.php");
    exit;
}
?>
