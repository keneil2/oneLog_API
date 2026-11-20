<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\subscription;

use App\Actions\GetPlanPricesAction;
use App\Actions\GetSubcriptionAction;
use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
                'plans' => $plans,
            ]
        );
    }

    public function show(Request $request): JsonResponse
    {
        $item = $request->user()->subscription()?->items()->first();
        $plan = Plan::where('paddle_id', $item?->product_id)->first();

        $price = null;

        if ($plan !== null) {
            $product = $this->getPlanPricesAction->handle([$plan->paddle_id])[0];
            $price = collect($product['prices'])->firstWhere('id', $item->price_id);
        }

        $subscription = [
            'subscription_name' => $plan !== null ? $plan->name : "free",
            'price' => $price !== null ? $price : [
                'billing_cycle' => [
                    'interval' => 'month',
                    'frequency' => null,
                ],
                'unit_price' => [
                    'amount' => '0',
                    'currency_code' => null,
                ],
            ],
        ];

        return ApiResponseHandler::success('subscription', $subscription);
    }
}
