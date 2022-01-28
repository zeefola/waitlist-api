<?php

namespace App\Traits;

trait ApiResponse
{
    public static function successResponse($message, $code)
    {
        return response()->json(['success' => true, 'message' => $message], $code);
    }

    public static function successResponseWithData($data, $message, $code)
    {
        return response()->json(['success' => true, 'message' => $message, 'data' => $data], $code);
    }

    public static function errorResponse($message, $code)
    {
        return response()->json(['success' => false, 'message' => $message], $code);
    }
}