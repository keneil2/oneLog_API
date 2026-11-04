<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\ApiResponseHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

final class CreateSessionAction
{
    /**
     * @param  array{email: string, password: string}  $credentials
     */
    public function handle(array $credentials): JsonResponse
    {
        $key = 'login-attempt-for:' . strtolower($credentials['email']);

        $failedMessage = 'Invalid Email or Password';

        $this->checkRateLimit($key, $failedMessage);
        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);

            return ApiResponseHandler::success('Authenticated Successfully');
        }

        RateLimiter::increment($key, 60);

        throw new AuthenticationException($failedMessage);
    }
    private function checkRateLimit($key, &$failedMessage): void
    {
        $perMinute = (int) config('login_attempts_per_minute');
        if (RateLimiter::tooManyAttempts($key, $perMinute)) {
            $seconds = RateLimiter::availableIn($key);
            $failedMessage = 'You may try again in ' . $seconds . ' seconds.';
            throw new TooManyRequestsHttpException($seconds, $failedMessage);
        }
    }
}
