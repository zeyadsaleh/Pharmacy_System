<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMedicine extends Model
{
  protected $fillable = [
      'order_id', 'medicine_id', 'pharmacy_id', 'price', 'quantity'
  ];

  public function pharmacy(){
      return $this->belongsTo('App\Pharmacy');
  }
}
