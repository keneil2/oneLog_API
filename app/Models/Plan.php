<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];
public function plan_feature(){
        return $this->hasMany(PlanFeature::class);
}

}
