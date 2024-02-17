<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

define('FROM_EMAIL', 'SET YOUR EMAIL');
define('FROM_NAME', 'Navod');

// Function to send email
function sendEmail($toEmail, $subject, $body, $toName = null) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                       // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                              // Enable SMTP authentication
        $mail->Username   = 'SET YOUR EMAIL';      // SMTP username
        $mail->Password   = 'SET USER PASSWORD';               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       // Enable implicit TLS encryption
        $mail->Port       = 465;                               // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Set sender and recipient
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($toEmail, $toName);                  // Add a recipient
        $mail->addReplyTo(FROM_EMAIL, FROM_NAME);

        // Email content
        $mail->isHTML(true);                                   // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);                    // Plain text version of the email body

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
