<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include '../db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status'=>'error','message'=>'Email not registered.']);
        exit;
    }

    $reset_code = rand(100000, 999999);
    $_SESSION['password_reset'] = [
        'email' => $email,
        'reset_code' => $reset_code
    ];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        
       
        $mail->Username   = 'bigorniaedrian@gmail.com';
        $mail->Password   = 'dyopdbcttyncyths';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('bigorniaedrian@gmail.com','CarCare');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Code';
        $mail->Body = "Your password reset code is: <b>$reset_code</b>";

        $mail->send();

        echo json_encode(['status'=>'success','message'=>'Reset code sent. Check your email.']);

    } catch (Exception $e) {
        echo json_encode(['status'=>'error','message'=>'Mailer Error: '.$mail->ErrorInfo]);
    }
}
?>
