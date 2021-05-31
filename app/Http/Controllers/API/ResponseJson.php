<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Response;

class ResponseJson {
    protected static $response = [
        'meta' => [
            'code' => 200,
        ],
        'data' => [],
        'message' => ''
    ];

    public static function success($data, $message){
        self::$response['data'] = $data;
        self::$response['message'] = $message;
        return response()->json(
            self::$response,
            Response::HTTP_OK
        );
    }

    public static function error($message){
        self::$response['message'] = $message;
        return response()->json(
            self::$response,
            Response::HTTP_INTERNAL_SERVER_ERROR 
        );
    }
}