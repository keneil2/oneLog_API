<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Actions\CreateSubscriptionAction;
use App\Actions\CreateUserAction;
use App\Actions\GetPlanPricesAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct(
        protected CreateSubscriptionAction $createSubscriptionAction,
        protected GetPlanPricesAction $getPlanPricesAction,
    ) {}
    public function store(StoreUserRequest $request, CreateUserAction $createUserAction)
    {
        $responseMessage = "User created Successfully!"; 
        
       $createUserAction->handle($request->validated());

        return ApiResponse::success(message: $responseMessage, status: ApiResponse::HTTP_CREATED);
    }
}
