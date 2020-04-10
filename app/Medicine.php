<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Medicine extends Model
{

    protected $fillable = [
        'name', 'type'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_medicine');
    }
}
