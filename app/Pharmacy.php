<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
      return $this->morphOne('App\User', 'profile');
    }

    public function area() {
      return $this->belongsTo('App\Area');
  }

}
