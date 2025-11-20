<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include '../db.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password){
        echo json_encode(['status'=>'error','message'=>'Passwords do not match.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        echo json_encode(['status'=>'error','message'=>'Email already registered.']);
        exit;
    }

    $verification_code = rand(100000, 999999);


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $_SESSION['pending_user'] = [
        'full_name' => $full_name,
        'email' => $email,
        'contact' => $contact,
        'address' => $address,
        'password' => $hashed_password,
        'verification_code' => $verification_code
    ];

  $mail = new PHPMailer(true);
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
    $mail->Subject = 'Email Verification Code';
    $mail->Body = "Your verification code is: <b>$verification_code</b>";

    $mail->send();

    // Send only JSON, no extra output
    echo json_encode(['status'=>'verify','email'=>$email]);

} catch (Exception $e) {
    echo json_encode(['status'=>'error','message'=>'Mailer Error: ' . $mail->ErrorInfo]);
}

}
?>
