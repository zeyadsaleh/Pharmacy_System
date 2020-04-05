<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $fillable = [
    'orders', 'delivering_address', 'is_insured', 'status'
  ];

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
