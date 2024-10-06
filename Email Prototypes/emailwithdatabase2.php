<?php
// initialization ng auto email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\php\PHPMailer-6.9.1\src\Exception.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\PHPMailer.php';
require 'C:\xampp\php\PHPMailer-6.9.1\src\SMTP.php';

$mail = new PHPMailer(true);

//coonection ng database
$servername = "localhost";
$username = "root";
$password = "";

try{ // first try is para sa database
    $conn = new PDO(
        "mysql:host=$servername; dbname=websys_qualitrack", 
        $username, 
        $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{ //2nd try is para sa database
        // standard syntax yata tong mga toh
        $mail->SMTPDebug = 0; 
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = '2022308046@dhvsu.edu.ph'; //email ng magsesend
        $mail->Password = 'rhgb fbes bnwm hbkm'; // need pa isetup mismo emai
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 

        // standard syntax sa quesry yata tong mga toh
        $query = $conn->prepare("SELECT studentDEMAIL, studentPEMAIL from student_information"); 
        $query->execute();
        $result = $query->FetchAll(PDO::FETCH_ASSOC);

        $mail->isHTML(true); 
        $mail->Subject = 'Good!';
        $mail->Body    = 'Dapat makita mo toh <br> both personal and dhvsu email';
        $mail->AltBody = 'Dapat makita mo toh <br> both personal and dhvsu email (Text only version)';

        foreach ($result as $email) { // looping since madami email address
            $mail->addAddress($email['studentDEMAIL']); // ilalgay yung first email
            $mail->addAddress($email['studentPEMAIL']);
            $mail->send(); 
            $mail->clearAddresses(); // tatangalin
        }
        echo 'Message has been sent';
        
    }catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo();
    }
    
}catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>