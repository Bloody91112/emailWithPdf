<?php

namespace app;

use function Couchbase\defaultDecoder;

class Validator
{
    public static function validate(array $request, array $files): array|string
    {
        /** Возвращаемый массив*/
        $response = [
            'errors' => [],
            'fields' => [],
        ];

        /** Поля для валидции и правила для них*/
        $rules = [
            'executor_act_id' => 'integer|30',
            'document_date' => 'string|50',
            'performer' => 'string|50',
            'service_title' => 'string|50',
            'price' => 'integer|20',
            'executor_company_title' => 'string|50',
            'executor_email' => 'string|100',
            'executor_inn' => 'integer|50',
            'executor_kpp' => 'integer|50',
            'executor_address' => 'string|100',
            'executor_account' => 'integer|50',
            'executor_account_kor' => 'integer|50',
            'executor_bank_title' => 'string|50',
            'executor_bik' => 'integer|50',
            'executor_phone' => 'integer|12',
            'executor_fio' => 'string|100',
            'customer_company_title' => 'string|100',
            'customer_email' => 'string|100',
            'customer_inn' => 'integer|50',
            'customer_kpp' => 'integer|50',
            'customer_address' => 'string|100',
            'customer_account' => 'integer|50',
            'customer_account_kor' => 'integer|50',
            'customer_bank_title' => 'string|100',
            'customer_bik' => 'integer|50',
            'customer_phone' => 'integer|12',
            'customer_fio' => 'string|100',
            'logo' => 'image',
            'executor_signature' => 'image',
            'executor_seal' => 'image',
            'customer_signature' => 'image',
            'customer_seal' => 'image',
        ];

        /** Перебор полей из реквеста и их валидация с помощью вышеуказанных правил*/
        foreach ($request as $key => $field) {
            if (empty($field)) {
                $response['errors'][] = ['field' => $key, 'reason' => 'Укажите значение'];
                continue;
            }

            if (!isset($rules[$key])) {
                $response['errors'][] = ['field' => $key, 'reason' => 'Неизвестное поле'];
                continue;
            };

            $field_rules = explode('|', $rules[$key]);

            $type = is_numeric($field) ? 'integer' : 'string';

            if ($type !== $field_rules[0]) {
                $response['errors'][] = [
                    'field' => $key,
                    'reason' => 'Неверный тип ввода',
                    'value' => $field,
                    'type' => $type,
                    'should' => $field_rules[0]
                ];
                continue;
            }

            if (mb_strlen($field) > (int)$field_rules[1]) {
                $response['errors'][] = [
                    'field' => $key,
                    'reason' => 'Превышен размер ввода'
                ];
                continue;
            }

            $response['fields'][$key] = $field;

        }
        /** Перебор файлов из реквеста */
        foreach ($files as $key => $file){
            if (empty($file['size'])){
                $response['errors'][] = ['field' => $key, 'reason' => 'Загрузите изображение'];
                continue;
            }
            $response['fields'][$key] = $file;
        }

        return $response;
    }
}
