<?php

declare(strict_types=1);

use App\Http\Controllers\V1\SessionController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'store']);
