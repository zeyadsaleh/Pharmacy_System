<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyApiEmail;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail);
    }
}
