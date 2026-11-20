<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
final class ApiResponseHandler
{
    const HTTP_CREATED = 201;
    public static function success(string $message, mixed $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error(string $message, int $code=500,$title=null): JsonResponse
    {
        return response()->json([
            'success' => false,
            "title"=>$title,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}
