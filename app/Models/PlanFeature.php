<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
      protected $guarded = [];

      public function plan(){
        return $this->belongsTo(Plan::class);
      }

      public function feature(){
       return $this->belongsTo(Feature::class);
      }
}
