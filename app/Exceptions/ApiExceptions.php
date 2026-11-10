<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Helpers\ApiResponseHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
class ApiExceptions
{
    public $exceptions = [
        HttpResponseException::class => 'handleValidationExceptions',
        AuthenticationException::class => "handleAuthException",
        QueryException::class => "handleQueryException",
        RouteNotFoundException::class => "handleRouteNotFoundException"
    ];

    public function handleValidationExceptions(ValidationException $exception, Request $request): JsonResponse
    {
        $status = $exception->getResponse()->getStatusCode();

        return response()->json([
            'success' => false,
            'title' => "Validation Error Occured",
            'errors' => $exception->status,
        ], $status);

    }


    function handleAuthException(AuthenticationException $exception, Request $request): JsonResponse
    {
        $message = $exception->getMessage();
        $this->localLog($message,$exception, $request?->data ?? []);
        return ApiResponseHandler::error($message, 401, "Unathenticated", );
    }

    public function handleQueryException(QueryException $exception, Request $request): JsonResponse
    {
        $ms = $exception->getMessage();
        $this->localLog($ms, $exception, [
            "request" => $request,
            "RawSQL" => $exception->getRawSql(),
        ]);
        return ApiResponseHandler::error("Opps! Something wrong please try again or contact the website adminstrator if the issue persist!");
    }

    function handleRouteNotFoundException(RouteNotFoundException $exception, Request $request): JsonResponse
    {
        $message = $exception->getMessage();
        $this->localLog($message, $exception);
        return ApiResponseHandler::error("Opps! Something wrong please try again or contact the website adminstrator if the issue persist!");
    }
    public function localLog($message, Exception $exception, array $data = []): void
    {
        Log::error($message, [
            [
                "message" => $exception->getMessage(),
                "file" => $exception->getFile(),
                "line number" => $exception->getLine(),
                ...$data
            ]
        ]);
    }

}
