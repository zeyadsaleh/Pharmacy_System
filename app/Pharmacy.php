<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $guarded = [];

    public function user() 
    { 
      return $this->morphOne('App\User', 'profile');
    }

}
