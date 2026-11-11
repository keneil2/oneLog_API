<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('useages', function (Blueprint $table) {
            $table->id();
            $table->foreignId("billable")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("plan_feature_id")->references("id")->on("plan_features")->cascadeOnDelete();
            $table->timestamp("period_start");
            $table->timestamp("period_end");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('useages');
    }
};
