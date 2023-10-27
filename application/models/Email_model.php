<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
    }

    public function send_email()
    {

        // PHPMailer object
        $response = false;
        $mail = new PHPMailer();


        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->Host     = 'mail.teammetal.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPSecure = 'TLS';
        $mail->SMTPAuth = false;
        $mail->Username = 'johancossten@teammetal.com'; // user email
        $mail->Password = 'Teammetal123*'; // password email
        $mail->SMTPSecure = 'starttls';
        $mail->Port     = 26;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('johancossten@teammetal.com', ''); // user email
        $mail->addReplyTo('johancossten@teammetal.com', ''); //user email

        // Add a recipient
        $mail->addAddress('johancossten@teammetal.com'); //email tujuan pengiriman email

        // Email subject
        $mail->Subject = 'Reminde For Training Plan, Evaluation, And Performance Appraisal Status'; //subject email

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = "<h3>Dear All,</h3>
                        <p>Please Open Training Application, and Change Status for Training Plan, Evaluation, And Performance Appraisal</p>"; // isi email
        $mail->Body = $mailContent;

        // Send email
        if (!$mail->send()) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
}
