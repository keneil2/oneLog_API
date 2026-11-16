<?php

declare(strict_types=1);

use App\Http\Controllers\v1\Plan\PlanController;
use App\Http\Controllers\v1\subscription\SubscriptionController;
use Illuminate\Support\Facades\Route;

require __DIR__."/auth.php";

Route::get("/plans",[PlanController::class,"index"]);
Route::get("subscription/prices",[SubscriptionController::class,"index"]);


