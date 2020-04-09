<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name', 'gender', 'date_of_birth', 'national_id', 'avatar', 'mobile_number', 'is_insured'
    ];

    public function user()
    {
      return $this->morphOne('App\User', 'profile');
    }
}
