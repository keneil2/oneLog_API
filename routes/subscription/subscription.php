<?php

declare(strict_types=1);

use App\Http\Controllers\v1\Plan\PlanController;
use App\Http\Controllers\v1\subscription\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/plans', [PlanController::class, 'index']);
Route::prefix('subscription')->group(function () {
    Route::get('prices', [SubscriptionController::class, 'index']);
    Route::get('current', [SubscriptionController::class, 'show']);
});
