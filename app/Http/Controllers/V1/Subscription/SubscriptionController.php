<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\subscription;

use App\Actions\GetPlanPricesAction;
use App\Actions\GetSubcriptionAction;
use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Models\Plan;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Paddle\Cashier;

class SubscriptionController extends Controller
{
    public function __construct(
        protected GetSubcriptionAction $action,
        protected GetPlanPricesAction $getPlanPricesAction,
    ) {}

    // I think this is not need maybe ?
    public function index(): JsonResponse
    {
        $productIds = [
            config('plans.free.paddle_id'),
            config('plans.pro.paddle_id'),
            config('plans.enterprise.paddle_id'),
        ];
       
        $planPrices = $this->getPlanPricesAction->handle($productIds);

       $plans = $this->action->handle($planPrices);

        return ApiResponseHandler::success(
            'subscriptions ',
            [
                "plans" => $plans,
            ]
        );
    }

    public function store()
    {


    }

}
