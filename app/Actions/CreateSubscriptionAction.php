<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Laravel\Paddle\Cashier;

final class CreateSubscriptionAction
{
    public function handle(User $user, array $priceId): void
    {
        $user->subscribe($priceId, 'default');
    }
}
