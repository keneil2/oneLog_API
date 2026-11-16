<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\subscription;

use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Paddle\Cashier;

class SubscriptionController extends Controller
{
    // I think this is not need maybe ?
    public function index(): JsonResponse
    {

 $productIds = [
            config('plans.free.paddle_id'),
            config('plans.pro.paddle_id'),
            config('plans.enterprise.paddle_id'),
        ];
$productPrices=Cashier::api("GET","products",[
             "id"=>implode(",",$productIds),
             "include"=>"prices"
              ])["data"];

        $products = collect($productPrices)->keyBy('id');
        $plans=[];
        $plansAndFeatures = Plan::with('plan_feature.feature')->get()
            ->each(function (Plan $plan) use(&$plans,$products){
                $plans[] = [
                    'plan_details' => $plan,
                    'price'        => $products[$plan->paddle_id]['prices'][0]['unit_price'] ?? null,
                    'price_id'=>$products[$plan->paddle_id]['prices'][0]['id']
];
            });
return ApiResponseHandler::success('subscriptions ',
[
"plans"=>$plans
]
);
    }

    public function store() {


}

}
