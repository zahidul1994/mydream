<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable

{
   use Notifiable;
   use SoftDeletes;
    use HasRoles;
     protected $guard_name = 'superadmin';
        protected $guard ='admin';
        protected $dates=['deleted_at'];

        protected $fillable = [
            'firstname','lastname', 'email', 'password','image','phone','status','gender'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];


     public function gender()
    {
        return $this->belongsTo('App\Gender','gender','id');
    }

     public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
