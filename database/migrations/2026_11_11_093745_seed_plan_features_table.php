<?php

declare(strict_types=1);

use App\Models\Feature;
use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // fetch plans
        $planIds = [];
        $planConfig=config("plans");
        foreach($planConfig as  $plan){
        $planIds[]=$plan["paddle_id"];
        }
                              
        $plans = Plan::whereIn("paddle_id", $planIds)->get();

        // get all features
        $features = Feature::all();

        // setup features per plan
      $data=  $plans->flatMap(fn ($plan) =>$this->getfeaturePlan($plan,$features) )->all();
      PlanFeature::insert($data);
    }

    function getfeaturePlan(Plan $plan, Collection $features)
    {
        $limitedFeatures = [
            'free' => [
                'events included' => 300_000,
                'days lookback' => 14,
                'thresholds per application' => 0,
            ],
            'pro' => [
                'events included' => 7_500_000,
                'days lookback' => 30,
                'thresholds per application' => 10,
            ],
            'enterprise' => [
                'events included' => 30_000_000,
                'days lookback' => 60,
                'thresholds per application' => 20,
            ],
        ];

        return $features->map(function (Feature $feature) use ($plan, $limitedFeatures) {
            return [
                "plan_id" => $plan->id,
                "feature_id" => $feature->id,
                "quota_amount" => $feature->type == "unlimited" ? PHP_INT_MAX : $limitedFeatures[$plan->slug][$feature->name],
            ];
        })->all();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
