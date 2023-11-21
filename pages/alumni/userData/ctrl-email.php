<?php
require '../../../includes/conn.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';


if (isset($_POST['sendEmail']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    // Fetch all alumni
    $result = $db->query("SELECT * FROM tbl_form");

    while ($row = $result->fetch_assoc()) {
        $mail = new PHPMailer(true);

        try {
               //Server settings
               $mail->SMTPDebug = 0;                      //Enable verbose debug output
               $mail->isSMTP();                                            //Send using SMTP
               $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
               $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
               $mail->Username   = 'apikey';                     //SMTP username
               $mail->Password   = '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';                               //SMTP password
               $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
               $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
           
               //Recipients
               $mail->setFrom('saintfrancisalumnisystem@gmail.com', 'SFAC Alumni System');
               $mail->addAddress($row['email']);     //Add a recipient
               // $mail->addAddress('ellen@example.com');               //Name is optional
               // $mail->addReplyTo('info@example.com', 'Information');
               // $mail->addCC('cc@example.com');
               // $mail->addBCC('bcc@example.com');
           
               // //Attachments
               // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
               // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
           
               //Content
               $mail->isHTML(true);                                  //Set email format to HTML
                       $mail->Subject = 'Update | Alumni Information';
                       $mail->Body    = '
                       Blessed day, Franciscan Alumni : <br><br>
                       The Saint Francis of Assisi College Alumni Association Department would like<br>
                       an update from you as another year has gone by. In compliance with the rules governing
                       data protection, we request that you update your information in our alumni tracking system.
                       The SFAC Alumni Association Department will securely handle nd keep the information that you encrypt.
                       If the information has already been updated or there is no need to update, please disregard this letter.<br><br>
                       Thankyou, and Godbless<br><br>
                       Saint Francis of Assisi College - Las Piñas<br>
                       All rights reserved.';
           
               $mail->send();
               
               header("location: ../alumni-form.php");
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           } 
                   } 
                      
    header("location: ../alumni-form.php");
                   
           
           
           
        
           
    }





?>