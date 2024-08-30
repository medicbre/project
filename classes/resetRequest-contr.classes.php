<?php

include "../classes/dbh.class.php";
include "resetRequest.classes.php";
include "../vendor/autoload.php";

class ResetRequestContr extends ResetRequest {

    //Sta nam je sve potrebno za resetovanje lozinke
    protected $selector;
    protected $token;
    protected $url;
    protected $expires;
    protected $userEmail;
    private $model;


    public function __construct($userEmail) {
        $this->userEmail = $userEmail;
        $this->selector = bin2hex(random_bytes(8));
        $this->token = random_bytes(32);
        $this->url = "http://localhost/dicme/chapterII/php/objektno/loginoop/create-new-password.php?selector=" . $this->selector . "&validator=" . bin2hex($this->token);
        $this->expires = date("U") + 1800;
        $this->model = new ResetRequest();
    }

    //Poziva model da obradi stare zahteve i umetne novi, 
    //nakon čega poziva metodu sendResetEmail() da pošalje email.
    public function processResetRequest() {
        $this->model->deleteOldRequests($this->userEmail);
        $hashedToken = password_hash($this->token, PASSWORD_DEFAULT);
        $this->model->insertResetRequest($this->userEmail, $this->selector, $hashedToken, $this->expires);
        $this->sendResetEmail();
    }
    private function sendResetEmail() {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = '2050075e982e3d';
            $mail->Password   = 'ee8addfb1227f1';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;

            $mail->setFrom('dicme@web.rs', 'Ilija');
            $mail->addAddress($this->userEmail);
            $url = $this->url;

            ob_start();
            include "../mail.php";
            $emailBody = ob_get_clean();

            $mail->isHTML(true);
            $mail->Subject = 'Reset your password';
            //$mail->Body    = 'Please click the following link to reset your password: <a href="' . $this->url . '">' . $this->url . '</a>';
            $mail->Body    = $emailBody;
            //$mail->AltBody = 'Please click the following link to reset your password: ' . $this->url;
            'This is the body in plain text for non-HTML mail clients';


            $mail->send();
            echo 'Reset email has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


