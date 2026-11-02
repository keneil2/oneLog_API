<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
final class ApiResponse
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

    public static function error(string $message, int $code=500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}
