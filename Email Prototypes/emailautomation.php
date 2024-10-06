<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer files
require 'C:\xampp\php\PHPMailer-6.9.1\src\Exception.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\PHPMailer.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\SMTP.php';

// Initialize the PHPMailer object
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 2; // Disable debugging (use 2 for verbose output)
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '2022308046@dhvsu.edu.ph'; // Your email
    $mail->Password = 'rhgb fbes bnwm hbkm'; // Your email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; // TLS port
    
    // Email headers
    $mail->setFrom('2022308046@dhvsu.edu.ph', 'klarence'); // Sender email and name
    $mail->addAddress('klarencedavidbaluyut14@gmail.com'); // Add recipient
    //$mail->addAddress('XYZ@gmail.com'); // Add more recipients
    //$mail->addAddress('insaaf@gmail.com');

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Good!';
    $mail->Body    = 'Hi there!';
    $mail->AltBody = 'Hi there! (Text only version)'; // Plain text version

    // Attach an image
    //$mail->addAttachment('C:/Users/Dell/Downloads/Garbage/Cartoon.jpg'); // Add image attachment

    // Attach a file
    //$mail->addAttachment('C:/Users/Dell/Desktop/slack.py'); // Add file attachment

    // Send email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
