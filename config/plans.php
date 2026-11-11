<?php

declare(strict_types=1);

return [

    'free' => [
        'name' => 'Free',
        'slug' => 'free',
        'paddle_id' => env('PADDLE_FREE_PLAN_ID'),
    ],

    'pro' => [
        'name' => 'Pro',
        'slug' => 'pro',
        'paddle_id' => env('PADDLE_PRO_PLAN_ID'),
    ],

    'enterprise' => [
        'name' => 'Enterprise',
        'slug' => 'enterprise',
        'paddle_id' => env('PADDLE_ENTERPRISE_PLAN_ID'),
    ],

];
