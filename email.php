<?php
//composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'oliver22official@gmail.com';
    $mail->Password = 'ilew ktix flnp bjeh';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //


    //Recipients
    $mail->setFrom('oliver22official@gmail.com', 'Mailer');
    $mail->addAddress('olirexminecraft@gmail.com', 'Joe User');     //Add a recipient
    $mail->addAddress('olirexminecraft@gmail.com');               //Name is optional

    /*
    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/

    //Content
    $mail->isHTML(false);
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is not the HTML message body in bold!';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
