<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


Class email{
    private $to;
    private $subject;
    private $message;
    private $mail;


    public function __construct($to, $subject, $message){
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->mail = new PHPMailer();
    }
    
    public function setMailUp(){

        try {
            //Server settings
            $this->mail->isSMTP();                                           
            $this->mail->Host       = 'smtp.gmail.com';                     
            $this->mail->SMTPAuth   = true;       
            
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = 587;       

            $this->mail->Username   = 'vanbriemenlucas@gmail.com';                     
            $this->mail->Password   = file_get_contents("../data/gmail.txt");                              
            $this->mail->setFrom('vanbriemenlucas@gmail.com', 'Lucas van Briemen');
            $this->mail->isHTML(true);
            
            $this->mail->SMTPDebug = 0;
        

        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function prepareMail(){
        $this->setMailUp();

        $this->mail->addAddress($this->to);
        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->message;
        $this->mail->Body   .= "<br><br>
                        Met vriendelijke groet,<br>
                        Challas '23<br>
                        gemaakt door: Lucas van Briemen<br><br>

                        <span style='color:#8fe507;'><b>GRAFISCH LYCEUM ROTTERDAM</b></span><br>
                        Heer Bokelweg 255, 3032 AD ROTTERDAM<br>
                        Postbus 1680, 3000 BR ROTTERDAM<br>
                        T: 31-06 83 23 7662<br>
                        <a href='http://glr.nl'>www.glr.nl</a>
                        ";
    }

    public function sendMail(){
        $this->mail->send();
    }
}