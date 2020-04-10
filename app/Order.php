<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Order extends Model
{

  protected $fillable = [
    'delivering_address', 'is_insured', 'created_by', 'status', 'pharmacy_id', 'user_id', 'doctor_id', 'total_price'
  ];

    public function user()
    {
        return $this->belongsTo('App\Client','user_id');
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'order_medicine');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id');
    }


    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public static function getPriceInDollars($cents)
    {
        $dollars = $cents / 100;
        return $dollars;
    }

    public function address()
    {
        return $this->belongsTo('App\Address', 'delivering_address');
    }
}
