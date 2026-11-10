<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

     return ApiResponseHandler::success('Account Successfully Verified', ['verified' => true]);
    }
}
