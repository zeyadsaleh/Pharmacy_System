<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderMedicine extends Model
{
  protected $table = 'order_medicine';

  protected $fillable = [
      'order_id', 'medicine_id', 'price', 'quantity'
  ];

  // public function medicines()
  // {
  //     return $this->belongsToMany('App\Medicine', 'order_medicine');
  // }
}
