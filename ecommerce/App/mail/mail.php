<?php
namespace App\mail;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

abstract class Mail {
    

    private string $host = 'smtp.mailtrap.io'; 
    private string $userName = 'c879c375711910'; 
    private string $password = '36eef973073a63'; 
    private int $port = 587;
    private string $encryption = 'tls';
    protected PHPMailer $mail;
    protected $mailTo,$subject,$body;
    public function __construct($mailTo,$subject,$body) {

        // setters
        $this->mailTo = $mailTo;
        $this->subject = $subject;
        $this->body = $body;

        $this->mail = new PHPMailer(true);

         //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = $this->host;                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = $this->userName;                     //SMTP username
        $this->mail->Password   = $this->password;                               //SMTP password
        $this->mail->SMTPSecure = $this->encryption;            //Enable implicit TLS encryption
        $this->mail->Port       = $this->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    }
    
    public abstract function send() :bool;
}