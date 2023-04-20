<?php

namespace app;

class MainController
{
    public static function run(): string
    {

        $data = Validator::validate($_REQUEST, $_FILES);

        if (!empty($data['errors'])) {
            return ResponseJson::create(['errors' => $data['errors']]);
        }

        $document = PDFController::create($data['fields']);

        $isSent = MailController::send($document, $data['fields']['customer_email'], $data['fields']['customer_fio']);
        $message = $isSent ? 'Письмо успешно отправлено' : 'Письмо не отправлено, проверьте указанную почту';
        return ResponseJson::create(['message' => $message]);
    }
}