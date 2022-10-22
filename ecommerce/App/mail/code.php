<?php


namespace App\Mail;

use App\mail\Mail;
use PHPMailer\PHPMailer\Exception;


class code extends Mail {
    

    public function send() :bool
    {

        try{
            //Recipients
            $this->mail->setFrom('ecommerce@gmail.com', 'ecommerce'); 
            $this->mail->addAddress($this->mailTo); 
            $this->mail->isHTML(true);
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;

            $this->mail->send();
            
            return true;
        } catch (Exception $e) {
           
            return false;
        }
        
    }
}
