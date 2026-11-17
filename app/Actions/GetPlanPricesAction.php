<?php

declare(strict_types=1);

namespace App\Actions;

use Laravel\Paddle\Cashier;

final class GetPlanPricesAction
{
    public function handle(array $productIds): array
    {
        $productPrices = Cashier::api("GET", "products", [
            "id" => implode(",", $productIds),
            "include" => "prices"
        ])["data"];
        return $productPrices;
    }
}
