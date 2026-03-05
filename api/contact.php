<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$company = $data['company'] ?? '';
$service = $data['service'] ?? '';
$message = $data['message'] ?? '';

$mail = new PHPMailer(true);

try {

$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'akhileshs@bimdigital.in';
$mail->Password   = 'mons wfgf xuxk emko';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

$mail->setFrom('akhileshs@bimdigital.in', 'BIM Digital Website');
$mail->addAddress('akhileshs@bimdigital.in');

$mail->Subject = "New Contact Form Lead";

$mail->Body = "
Name: $name
Email: $email
Phone: $phone
Company: $company
Service: $service

Message:
$message
";

$mail->send();

echo json_encode([
"success" => true
]);

} catch (Exception $e) {

echo json_encode([
"success" => false,
"detail" => $mail->ErrorInfo
]);

}