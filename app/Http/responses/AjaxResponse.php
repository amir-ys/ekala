<?php

namespace App\Http\responses;

use Illuminate\Database\Eloquent\Model;

class AjaxResponse
{
    public static function sendData( $data , string $message = null)
    {
        return response()->json([
            'status' => 1 ,
            'message' =>  $message,
            'data' => $data ,

        ]);
    }

    public static function success(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 1 ,
            'message' =>  $message,
        ]);
    }


    public static function error(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => -1 ,
            'message' =>  $message,
        ]);
    }

}
