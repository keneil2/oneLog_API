<?php

declare(strict_types=1);

use App\Http\Controllers\V1\EmailVerificationController;
use App\Http\Controllers\V1\SessionController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'store']);
Route::get('/auth/me', [SessionController::class, 'show']);

Route::post('/register', [UserController::class, 'store']);

Route::get('/auth-test', function () {
    echo ' authenticated';
})->middleware('auth:sanctum');

Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
