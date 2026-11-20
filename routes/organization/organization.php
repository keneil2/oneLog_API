<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Organization\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('organization')->group(function () {
    Route::post('/', [OrganizationController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/exists', [OrganizationController::class, 'exists'])->middleware('auth:sanctum');
});
