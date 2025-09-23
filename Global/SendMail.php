<?php
// Include Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail {
    public function sendMail($conf, $mailCnt) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // 2 for debug output
            $mail->isSMTP();
            $mail->Host       = $conf['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $conf['smtp_user'];
            $mail->Password   = $conf['smtp_pass'];
            $mail->SMTPSecure = ($conf['smtp_secure'] === 'ssl') 
                                ? PHPMailer::ENCRYPTION_SMTPS 
                                : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $conf['smtp_port'];

            // Recipients
            $mail->setFrom($mailCnt['mail_from'], $mailCnt['name_from']);
            $mail->addAddress($mailCnt['mail_to'], $mailCnt['name_to']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $mailCnt['subject'];
            $mail->Body    = $mailCnt['body'];

            $mail->send();
            return true; // Email sent
        } catch (Exception $e) {
            return "Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
