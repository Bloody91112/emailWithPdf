<?php


namespace app;


use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;

class MailController
{

    public static function send(string $document, string $customerEmail, string $customerName): bool
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'ssl://smtp.mail.ru';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = 'vladimir-berl2@mail.ru';
        $mail->Password = 'mrxNek9kCrqSV8zDCHT2';
        $mail->setFrom('vladimir-berl2@mail.ru', 'admin');
        $mail->addAddress($customerEmail, $customerName);
        $mail->Subject = 'Договор';
        $mail->Body = 'Договор';
        $mail->addStringAttachment($document, 'agreement.pdf');
        $mail->send();
        return true;

    }
}