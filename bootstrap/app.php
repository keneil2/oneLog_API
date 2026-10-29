<?php

declare(strict_types=1);

use App\Exceptions\ApiExceptions;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Exception $e, Request $request): ?JsonResponse {
            $apiExceptionHandler = new ApiExceptions;
            $class = get_class($e);

            if (! array_key_exists($class, $apiExceptionHandler->exceptions)) {
                return null;
            }
            $method = $apiExceptionHandler->exceptions[$class];
            Log::debug($method);

            return $apiExceptionHandler->$method($e,$request);

        });
    })->create();
