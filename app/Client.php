<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name', 'gender', 'date_of_birth', 'national_id', 'avatar', 'avatar_file_name','mobile_number', 'is_insured'
    ];

    public function user()
    {
      return $this->morphOne('App\User', 'profile');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
