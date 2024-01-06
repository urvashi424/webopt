<?php

namespace App\Helpers;

class Response
{
    public static function success($message,$data = [])
    {
        return json_encode([
            'data' => $data,
            'message' => $message,
            'success' => true
        ]);
    }

    public static function error($message,$data = [])
    {
        return json_encode([
            'data' => $data,
            'message' => $message,
            'success' => false
        ]);
    }
}
