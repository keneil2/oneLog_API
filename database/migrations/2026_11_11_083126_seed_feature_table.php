<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $features = [
            [
                'type' => 'metered',
                'name' => 'events included',
                'unit' => 'events',
            ],
            [
                'type' => 'metered',
                'name' => 'days lookback',
                'unit' => 'lookback_days',
            ],

            [
                'type' => 'unlimited',
                'name' => 'applications',
                'unit' => 'apps',
            ],

            [
                'type' => 'metered',
                'name' => 'days lookback',
                'unit' => 'lookback_days',
            ],

            [
                'type' => 'unlimited',
                'name' => 'environments',
                'unit' => 'environments',
            ],

            [
                'type' => 'unlimited',
                'name' => 'seats',
                'unit' => 'seats',
            ],

            [
                'type' => 'unlimited',
                'name' => 'email support',
                'unit' => 'support',
            ],

            [
                'type' => 'metered',
                'name' => 'thresholds per application',
                'unit' => 'thresholds',
            ],

            [
                'type' => 'unlimited',
                'name' => 'discounted additional events',
                'unit' => 'events',
            ],
        ];
        DB::table('features')->insert($features);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
