<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


Class email{
    private $to;
    private $subject;
    private $message;
    private $mail;


    public function __construct($to, $subject, $message){
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->mail = new PHPMailer(true);
    }
    
    public function setMailUp(){

        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $this->mail->isSMTP();                                           
            $this->mail->Host       = 'smtp.gmail.com';                     
            $this->mail->SMTPAuth   = true;                                  
            $this->mail->Username   = 'softwaredeveloperglr@gmail.com';                     
            $this->mail->Password   = file_get_contents("../data/gmail.txt");                              
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           
            $this->mail->Port       = 465;       
            
            $this->mail->isHTML(true);
            
            $this->mail->do_debug = 0;
            $this->mail->SMTPDebug = 0;
        
            $this->mail->setFrom('softwaredeveloperglr@gmail.com', 'Lucas van Briemen');

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


$test = new email("088875@glr.nl", "test", "test");
$test->prepareMail();
$test->sendMail();