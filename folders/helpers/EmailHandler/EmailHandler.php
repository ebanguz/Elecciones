<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler {

    public $mail;
    private $jsonFile;

    function __construct($directory)
    {
        $this->mail = new PHPMailer(true);
        $this->jsonFile = new JsonFileHandler($directory);
    }

    public function sendEmail($to,$subject,$content) {

        try {

        $configuration = $this->jsonFile->getJSON();

        // Configuration

        $this->mail->SMTPDebug = 2;
        $this->mail->isSMTP();
        $this->mail->Host = $configuration->host;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $configuration->username;
        $this->mail->Password = $configuration->password;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = $configuration->port;
        $this->mail->setFrom($configuration->username,$configuration->from);

        //Destinatario

        $this->mail->addAddress($to);

        //Contenido

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $content;

        //Enviar correo

        $this->mail->send();

        } catch(Exception $e) {

            echo "El mensaje no pudo ser enviado por el siguiente error {$this->mail->ErrorInfo}";
            exit();
        }

        
    }
}

?>