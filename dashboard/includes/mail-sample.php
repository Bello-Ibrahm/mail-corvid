<?php
require_once('../vendor/PHPMailer/src/PHPMailer.php');
require_once('../vendor/PHPMailer/src/Exception.php');
require_once('../vendor/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private static $host = "input_your_host";
    private static $username = "input_your_username";
    private static $password = "input_your_password";

    public static function sendMail($to, $subject, $body){
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = self::$host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = self::$username;                     //SMTP username
            $mail->Password   = self::$password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //           //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('mailcorvid@an-nur-info-tech.com', 'Mailcorvid client');
            $mail->addAddress($to);     //Add a recipient
            // $mail->addReplyTo($to);
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
    
            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
            return false;
        }
    }

    public static function contactCreationMail($to, $name)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = self::$host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = self::$username;                     //SMTP username
            $mail->Password   = self::$password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //           //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mailcorvid@an-nur-info-tech.com', 'Mailcorvid client');
            $mail->addAddress($to);     //Add a recipient
            // $mail->addReplyTo($to);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Mailing list subscription";
            $mail->Body    = "
                <p>Hi <b>$name</b></p>
                <p>You have successfully subscribed to be receiving mailing newsletter</p>
                <br>
                <br>
                <p>Powered by Mailcorvid</p>
                ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
            return false;
        }
    }

    public static function forgotPasswordEmail($to, $token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = self::$host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = self::$username;                     //SMTP username
            $mail->Password   = self::$password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //           //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mailcorvid@an-nur-info-tech.com', 'Mail');
            $mail->addAddress($to);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password Reset Request';
            $mailTemplate =
                "
                    <h1> Password reset request for $to </h1>
                    <h4> You requested for password reset if yes Please click 
                        <a href='https://mailcorvid.an-nur-info-tech.com/password-reset?token=$token'>
                        Here
                        </a>
                    to complete the reset of the password
                    </h4>
                    <p>
                        If you did not request please click 
                        <a href='https://mailcorvid.an-nur-info-tech.com/cancel-password-reset?token=$token'>
                        Here
                        </a>
                    </p> 
                ";
            $mail->Body    = $mailTemplate;

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
            return false;
        }
    }
}
