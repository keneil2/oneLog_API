<?php

declare(strict_types=1);

use App\Http\Controllers\V1\SessionController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'store']);

Route::post('/register',[UserController::class,"store"]);