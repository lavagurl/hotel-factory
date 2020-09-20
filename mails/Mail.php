<?php
namespace HotelFactory\mails;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';

class Mail
{
    private $email;
    public function sendMail($settings)
    {
        $this->email = new PHPMailer(true);
        try {
//Server settings
            //$this->email->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $this->email->isSMTP();                                            // Send using SMTP
            $this->email->Host = MAIL_HOST;                    // Set the SMTP server to send through
            $this->email->SMTPAuth = true;                                   // Enable SMTP authentication
            $this->email->Username = MAIL_USER;                     // SMTP username
            $this->email->Password = MAIL_PWD;                               // SMTP password
            $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->email->Port = 587;

            foreach ($settings as $key => $config) {
                $method = 'add' . ucfirst($key);
                if (method_exists(get_called_class(), $method)) {
                    $this->$method($config);

                }
            }
            $this->email->send();
            echo 'Mail correctement envoyé';
        } catch
        (Exception $e) {
            echo "Le message n'a pas pu s'envoyer : {$this->email->ErrorInfo}";
        }

    }
    private function addSender($sender)
    {
        $this->email->setFrom($sender["email"], $sender["pseudo"]);
    }
    private function addAddressee($addressee)
    {
        $this->email->addAddress($addressee["email"], $addressee["pseudo"]);
    }
    private function addBody($body)
    {
        echo($body["html"]);
        $this->email->isHTML($body["html"]);                                  // Set email format to HTML
        $this->email->Subject = $body["subject"];
        $this->email->Body = $body["body"];
        $this->email->AltBody = $body["altBody"];
    }

    public function testMail()
    {

        try {

//Recipients
            $this->email->setFrom('ne-pas-repondre@hotelfactory.com', 'Administrateur HotelFactory');
            $this->email->addAddress('hotelfactorytest@gmail.com', 'Joe User');     // Add a recipient
//             // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            //    $mail->addBCC('bcc@example.com');

// Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
            $this->email->isHTML(true);                                  // Set email format to HTML
            $this->email->Subject = 'Here is the subject';
            $this->email->Body = 'This is the HTML message body <b>in bold!</b>';
            $this->email->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->email->send();
            echo 'Message has been sent';
        } catch
        (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->email->ErrorInfo}";
        }
    }
}