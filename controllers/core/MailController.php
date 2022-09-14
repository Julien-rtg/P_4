<?php
namespace Controllers\core;

class MailController {

    public function sendMail(array $datas): ?string
    {
        $to = 'julien.rittl@gmail.com';
        $subject = $datas['object'];
        $message = 'Nom : ' . $datas['first_name'] . "\r\n";
        $message .= 'Prénom : ' . $datas['last_name'] . "\r\n";
        $message .= 'Message : ' . $datas['message'];
        $mail = mail($to, $subject, $message);
        if($mail){
            return 'success';
        } else {
            return 'error';
        }
    }
}
