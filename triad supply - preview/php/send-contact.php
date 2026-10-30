<?php
/**
 * Handle contact/manpower request form submissions.
 * Receives POST from contact.html form and sends email via PHPMailer.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../phpmailer/src/Exception.php';
require_once __DIR__ . '/../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json; charset=utf-8');

// Honeypot check
if (!empty($_POST['website'] ?? '')) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Submission rejected.']);
    exit;
}

$name        = trim($_POST['name'] ?? '');
 email         = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$type        = trim($_POST['type'] ?? '');
$message     = trim($_POST['message'] ?? '');

// Basic server-side validation
$errors = [];
if (strlen($name) < 2)            $errors[] = 'Please enter your full name.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
if (!preg_match('/^[0-9+\s()\-]{7,20}$/', $phone)) $errors[] = 'Please enter a valid phone number.';
if (empty($type))                 $errors[] = 'Please select who you are.';
if (strlen($message) < 10)        $errors[] = 'Please enter a message (at least 10 characters).';

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Build email body
$body  = "New manpower request received.\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Type: $type\n\n";
$body .= "Message:\n$message\n";

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = SMTP_AUTH;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port       = SMTP_PORT;

    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress(RECEIVER_EMAIL, 'Al-Atawi Group');
    $mail->addReplyTo($email, $name);

    $mail->Subject = "Manpower Request from $name";
    $mail->Body    = $body;

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Thank you! Your request has been sent. We will contact you soon.']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Could not send email. Please call us at +966 50 894 7616.']);
}