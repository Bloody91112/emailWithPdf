<?php

namespace app;

class MainController
{
    public static function run(): string
    {

        /** Валидация полей*/
        $data = Validator::validate($_REQUEST, $_FILES);

        /** Массив с ошибками, если они есть, на фронт*/
        if (!empty($data['errors'])) {
            return ResponseJson::create(['errors' => $data['errors']]);
        }

        /** сгенерированный PDF документ*/
        $document = PDFController::create($data['fields']);

        /** Отправка письма, возвращает true при успехе */
        $isSent = MailController::send($document, $data['fields']['customer_email'], $data['fields']['customer_fio']);

        /** Выводим конечный результат юзеру */
        $message = $isSent ? 'Письмо успешно отправлено' : 'Письмо не отправлено, проверьте указанную почту';
        return ResponseJson::create(['message' => $message]);
    }
}