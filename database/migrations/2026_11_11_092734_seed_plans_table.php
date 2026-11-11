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
        $plans = collect(config('plans'))->map(fn (array $plan): array => [
            'name' => $plan['name'],
            'slug' => $plan['slug'],
            'paddle_id' => $plan['paddle_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ])->values()->all();

        DB::table('plans')->insert($plans);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
