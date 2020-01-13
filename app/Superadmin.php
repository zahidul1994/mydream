<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends Authenticatable
{
 use Notifiable;

        protected $guard ='superadmin';

        protected $fillable = [
            'name', 'email', 'password','image','phone'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
