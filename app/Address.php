<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

  protected $table = 'addresses';

  protected $fillable = [
    'street_name', 'building_name', 'floor_number', 'flat_number', 'is_main', 'user_id', 'area_id'
  ];

  public function area() {
    return $this->belongsTo('App\Area');
  }
}
