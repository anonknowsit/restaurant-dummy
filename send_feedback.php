<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Collect form data safely
$name    = htmlspecialchars($_POST['name']);
$email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$tel     = htmlspecialchars($_POST['tel']);
$reason  = htmlspecialchars($_POST['reason']);
$message = htmlspecialchars($_POST['message']);

if (!$email) {
    die("Ungültige E-Mail-Adresse.");
}

// Compose email body
$body = "Name: $name\n";
$body .= "E-Mail: $email\n";
$body .= "Telefon: $tel\n";
$body .= "Grund: $reason\n";
$body .= "Nachricht:\n$message\n";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.de';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@hoian-nierstein.de'; // Your IONOS email address
    $mail->Password   = 'Ridgiphan';      // Your IONOS email password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('test@test.de', 'Webseiten-Kontakt');
    $mail->addAddress('info@hoian-nierstein.de'); // Your IONOS email address

    // Content
    $mail->Subject = 'Neue Nachricht vom Kontaktformular';
    $mail->Body    = $body;

    $mail->send();
    echo "Danke für Ihre Nachricht!";
} catch (Exception $e) {
    echo "Nachricht konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}";
}
?>