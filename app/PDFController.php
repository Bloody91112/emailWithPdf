<?php


namespace app;


use Dompdf\Dompdf;

class PDFController
{
    public static function create(array $data): ?string
    {

        $body  = '<body style="font-family: DejaVu Sans; display: flex; flex-direction: column; column-gap: 20px">';
        $body .=    '<div style="height:100px">';
        $body .=        '<img style="float:right" height=100 src=' . self::getBase64image($data['logo']) . ' >';
        $body .=    '</div>';
        $body .=    '<h3 style="text-align:center"> АКТ № ' . $data['executor_act_id'] . ' ОТ ' . $data['document_date'] . '</h3>';
        $body .=    '<hr>';
        $body .=    '<div>Исполнитель <b> Индивидуальный предпринематель '. $data['performer'] .' </b> </div>';
        $body .=    '<div>Заказчик <b> '. $data['customer_company_title'] .' </b> </div>';
        $body .=    '<div style="margin: 20px 0"> '. $data['service_title']  . ' - ' . $data['price'] .' рублей </div>';
        $body .=    '<div style="margin: 20px 0"> Общая стоимость выполненых работ, указанных услуг - ' . $data['price']  .  ' рублей </div>';
        $body .=    '<div style="margin: 10px 0"> '. $data['executor_email'] . ' </div>';
        $body .=    '<div style="display: flex; flex-direction: row; align-items: center; width: 100%">';


        $body .=        '<div style="flex: 1 1 50%; display: flex; flex-direction: column; row-gap: 10px; float: left; width: 50%">';
        $body .=            '<div style="width: 100%">Исполнитель: <b>' . $data['performer'] .'</b></div>';
        $body .=            '<div style="width: 100%">
                                ИНН <b style="text-decoration: underline; margin-right: 10px">' . $data['executor_inn'] .'</b>  
                                КПП <b style="text-decoration: underline; margin-right: 10px">' . $data['executor_kpp'] .'</b> 
                             </div>';
        $body .=            '<div style="width: 100%">Адрес <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_address'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Р/с <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_account'] .'</b> </div>';
        $body .=            '<div style="width: 100%">К/с <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_account_kor'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Банк <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_bank_title'] .'</b> </div>';
        $body .=            '<div style="width: 100%">БИК <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_bik'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Телефон <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_phone'] .'</b> </div>';
        $body .=            '<div style="display: flex; flex-direction: row; align-items: center; position: relative;">';
        $body .=                '<div style="float: left; width: 50%">';
        $body .=                    '<img height=70  style="position:absolute; top:0; left:0; display:block;" src=' . self::getBase64image($data['executor_signature']) . ' >';
        $body .=                    '<img height=100 style="display:block" src=' . self::getBase64image($data['executor_seal']) . ' >';
        $body .=                '</div>';
        $body .=                '<div style="float: right;width: 50%">Расшифровка подсписи <b style="margin-left: 20px; text-decoration: underline;">' . $data['executor_fio'] .'</b> </div>';
        $body .=            '</div>';
        $body .=        '</div>';



        $body .=        '<div style="flex: 1 1 50% display: flex; flex-direction: column; row-gap: 10px; float: right; width: 50%">';
        $body .=            '<div style="width: 100%">Заказчик: <b>' . $data['customer_company_title'] .'</b></div>';
        $body .=            '<div style="width: 100%">
                                ИНН <b style="text-decoration: underline; margin-right: 10px">' . $data['customer_inn'] .'</b>  
                                КПП <b style="text-decoration: underline; margin-right: 10px">' . $data['customer_kpp'] .'</b> 
                             </div>';
        $body .=            '<div style="width: 100%">Адрес <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_address'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Р/с <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_account'] .'</b> </div>';
        $body .=            '<div style="width: 100%">К/с <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_account_kor'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Банк <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_bank_title'] .'</b> </div>';
        $body .=            '<div style="width: 100%">БИК <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_bik'] .'</b> </div>';
        $body .=            '<div style="width: 100%">Телефон <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_phone'] .'</b> </div>';
        $body .=            '<div style="display: flex; flex-direction: row; align-items: center; position: relative;">';
        $body .=                '<div style="float: left; width: 50%">';
        $body .=                    '<img height=70  style="position:absolute; top:0; left:0; display:block;" src=' . self::getBase64image($data['customer_signature']) . ' >';
        $body .=                    '<img height=100 style="display:block" src=' . self::getBase64image($data['executor_seal']) . ' >';
        $body .=                '</div>';
        $body .=                '<div style="float: right;width: 50%">Расшифровка подсписи <b style="margin-left: 20px; text-decoration: underline;">' . $data['customer_fio'] .'</b> </div>';
        $body .=            '</div>';
        $body .=        '</div>';


        $body .=    '</div>';
        $body .= '</body>';


        $dompdf = new Dompdf();
        $dompdf->setPaper("letter", "portrait");
        $dompdf->loadHtml($body);
        $dompdf->render();

        return $dompdf->output();
    }


    public static function getBase64image($image):string
    {
        $path = $image['tmp_name'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}