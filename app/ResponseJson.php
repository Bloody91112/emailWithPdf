<?php

namespace app;

class ResponseJson
{
    public static function create(array $data, $status = 200): string
    {
        $data['status'] = $status;
        return json_encode($data);
    }

}