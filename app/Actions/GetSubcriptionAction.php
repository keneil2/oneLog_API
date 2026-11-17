<?php
declare(strict_types=1);
namespace App\Actions;
use App\Models\Plan;
use Illuminate\Http\Client\Response;
use Laravel\Paddle\Cashier;


final class GetSubcriptionAction
{
    public function handle(array$productPrices ): array{

        $products = collect($productPrices)->keyBy('id');

        $plans = [];

        Plan::with('plan_feature.feature')->get()
            ->each(function (Plan $plan) use (&$plans, $products) {
                $plans[] = [
                    'plan_details' => $plan,
                    'price' => $products[$plan->paddle_id]['prices'][0]['unit_price'] ?? null,
                    'price_id' => $products[$plan->paddle_id]['prices'][0]['id']
                ];
            });
        return $plans;
    }
}