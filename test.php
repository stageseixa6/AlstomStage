<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once "core/phpmailer/Exception.php";
require_once "core/phpmailer/PHPMailer.php";
require_once "core/phpmailer/SMTP.php";

$mail = new PHPMailer(true);

try{
    //configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //configure smtp
    $mail->isSMTP();
    $mail->Host="localhost";
    $mail->Port = 1025;

    //CharSet
    $mail->CharSet = "utf-8";

    //destinataires
    $mail->addAddress("test@site.fr");

    //Expediteur
    $mail->setFrom("site@site.fr");

    //contenu
    $mail->Subject = "sujet du message";
    $mail->Body = "test de mail";

    //envoi du mail
    $mail->send();

    //vérif envoi
    echo "mail envoyé";

}catch (Exception $e){
        echo "message non envoyé. Erreur : {$mail->ErrorInfo}";
}
