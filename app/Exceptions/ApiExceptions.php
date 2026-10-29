<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Helpers\ApiResponse;
class ApiExceptions
{
    public $exceptions = [
        HttpResponseException::class => 'handleValidationExceptions',
        AuthenticationException::class => "handleAuthException"
    ];

    public function handleValidationExceptions(ValidationException $exception,Request $request): JsonResponse
    {
        $status = $exception->getResponse()->getStatusCode();

        return response()->json([
            'success' => false,
            'errors' => $exception->status,
        ], $status);

    }


   function handleAuthException(AuthenticationException $exception,Request $request){
    $message = $exception->getMessage();
    $this->localLog($message,$request->data);    
   return ApiResponse::error($message,401);
    }
    public function localLog($message, array|null $data): void
    {
        Log::error($message, [$data]);
    }
}
