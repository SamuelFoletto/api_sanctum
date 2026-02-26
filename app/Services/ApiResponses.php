<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponses
{
    public static function success($data): JsonResponse
    {
        return response()->json(
            [
                'status' => 200,
                'message' => 'sucesso',
                'data' => $data
            ], 200
        );
    }

    public static function error($message): JsonResponse
    {
        return response()->json(
            [
                'status' => 500,
                'message' => $message,

            ], 200
        );
    }


    public static function unauthorized(): JsonResponse
    {
        return response()->json(
            [
                'status' => 401,
                'message' => "Acesso negado",

            ], 200
        );
    }
}
