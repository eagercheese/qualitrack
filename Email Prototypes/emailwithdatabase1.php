<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\php\PHPMailer-6.9.1\src\Exception.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\PHPMailer.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\SMTP.php';

$mail = new PHPMailer(true);

$servername = "localhost";
$username = "root";
$password = "";


try {
    $conn = new PDO(
        "mysql:host=$servername; dbname=websys_qualitrack", 
        $username, 
        $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    try {
        // standard syntax yata tong mga toh
        $mail->SMTPDebug = 0; 
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = '2022308046@dhvsu.edu.ph'; //email ng magsesend
        $mail->Password = 'rhgb fbes bnwm hbkm'; // need pa isetup mismo emai
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 
        
        // standard syntax yata tong mga toh
        $query = $conn->prepare("SELECT studentDEMAIL from student_information"); 
        $query->execute();
        $result = $query->FetchAll(PDO::FETCH_ASSOC);

        $mail->setFrom('2022308046@dhvsu.edu.ph', 'klarence'); 
        
        $mail->isHTML(true); 
        $mail->Subject = 'Good!';
        $mail->Body    = 'Hi there!';
        $mail->AltBody = 'Hi there! (Text only version)';
    
        // for image
        //$mail->addAttachment('C:/Users/Dell/Downloads/Garbage/Cartoon.jpg'); // Add image attachment
    
        // for files
        //$mail->addAttachment('C:/Users/Dell/Desktop/slack.py'); // Add file attachment
    
        foreach ($result as $email) { // looping since madami email address
            $mail->addAddress($email['studentDEMAIL']); // ilalgay yung first email
            $mail->send(); 
            $mail->clearAddresses(); // tatangalin
        }
    
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}




?>
