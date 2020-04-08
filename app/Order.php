<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $fillable = [
    'delivering_address', 'is_insured', 'created_by', 'status', 'pharmacy_id', 'user_id', 'doctor_id'];

    public function user()
    {
      return $this->belongsTo('App\Client');
    }

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
