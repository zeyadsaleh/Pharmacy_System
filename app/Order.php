<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $fillable = [
    'status',
  ];

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }

    public function pharmacy(){
        return $this->belongsTo('App\Pharmacy');
    }


}
