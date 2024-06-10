<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["tfn"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];
    
    try {
        //Server settings
        /*$mail->SMTPDebug = SMTP::DEBUG_SERVER; //
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'oliver22official@gmail.com';
        $mail->Password = 'ilew ktix flnp bjeh';
        $mail->SMTPSecure = 'tls';*/
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //
        $mail->isSMTP();
        $mail->Host = 'smtp.ionos.es';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'info@torosfive.es';
        $mail->Password = 'verOli2504';
        $mail->SMTPSecure = 'tls';


        //Recipients
        $mail->setFrom("info@torosfive.es", "Toros Five volley Ojen");
        $mail->addAddress('olirexminecraft@gmail.com', 'Oliver');        //A quien enviar

        /*
        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    */

        //Content
        $mail->isHTML(false);
        $mail->Subject = $asunto;
        $mail->Body = 'De: '.$nombre.'<br>Correo: '.$email.'<br>Telefono: '.$telefono.'<br>Mensaje: '.$mensaje;
        $mail->AltBody = 'De: '.$nombre.'\nCorreo: '.$email.'\nTelefono: '.$telefono.'\nMensaje: '.$mensaje;;

        $mail->send();
        header("location:../index.html?err=0");
    } catch (Exception $e) {
        header("location:../index.html?err=1");
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
