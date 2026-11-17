<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\Client\Response;
use Laravel\Paddle\Cashier;

final class CreateSubscriptionAction
{
    public function handle(array $priceId): void
    {
         auth()->user()->subscribe($priceId, 'default');
    }
}
