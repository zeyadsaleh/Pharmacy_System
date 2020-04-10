<?php

namespace App;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class Pharmacy extends Model
{
    use SoftDeletes,Billable;
    protected $guarded = [];

    public function user()
    {
      return $this->morphOne('App\User', 'profile');
    }

    public function area() {
      return $this->belongsTo('App\Area');
  }

}
