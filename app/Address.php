<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_name', 'building_name', 'flat_number','floor_number','is_main','user_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
