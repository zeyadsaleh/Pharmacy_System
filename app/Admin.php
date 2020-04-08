<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    //
    use Notifiable;

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password','remember_token',
        ];

        public function user()
        {
          return $this->morphOne('App\User', 'profile');
        }

}
