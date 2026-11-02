<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class SessionController extends Controller
{
    public function store(StoreSessionRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $key = 'login-attempt-for:' . strtolower($request->email);
        $perMinute = 3;
        $failedMessage = "Invalid Email or Password";
        if (RateLimiter::tooManyAttempts($key, $perMinute)) {
            $seconds = RateLimiter::availableIn($key);

            $failedMessage = 'You may try again in ' . $seconds . ' seconds.';
            throw new TooManyRequestsHttpException($seconds,$failedMessage);
        }

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);
            return ApiResponse::success("Authenticated Successfully");
        }

            RateLimiter::increment($key, 60);

        throw new AuthenticationException($failedMessage);
    }
}
