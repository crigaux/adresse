<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../vendor/autoload.php');

require_once(__DIR__ . '/../helpers/JWT.php');
require_once(__DIR__ . '/../helpers/SessionFlash.php');
require_once(__DIR__ . '/../helpers/testInputs.php');
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/regex.php');
require_once(__DIR__ . '/../models/User.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
    if (testInput($email, MAIL_REGEX) != 'true') {
        $errors['email'] = testInput($email, MAIL_REGEX);
    }

    if(User::isExist($email) == false) {
        SessionFlash::set('error', 'Cet email n\'existe pas');
        header('Location: /oubli-mot-de-passe');
        exit();
    }
    
    $user = User::get(NULL, $email);

    if($user == false) {
        $errors['email'] = 'Cet email n\'existe pas';
    }

    // Création du header
    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    // Création du payload
    $payload = [
        'user_id' => $user->id,
    ];

    $token = JWT::generate($header, $payload, 900);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contact.annexe.restaurant@gmail.com';                     //SMTP username
        $mail->Password   = 'fvagoshdamoiqmpu';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('contact.annexe.restaurant@gmail.com', 'Restaurant l\'Annexe');
        $mail->addAddress($email);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Mot de passe oublié';
        $mail->Body    = 'Bonjour ' . $user->firstname . ' ' . $user->lastname . ',<br> Veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe. <br> <a href="' . $_SERVER['HTTP_ORIGIN'] . '/modif-mdp?token=' . $token .'">Réinitialiser mon mot de passe</a> !';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        SessionFlash::set('message', 'Un email vous a été envoyé');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    http://projetdwwm.localhost/oubli-mot-de-passe
}
    include(__DIR__ . '/../views/templates/nav.php');
    include(__DIR__ . '/../views/forgotPwd.php');