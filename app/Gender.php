<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable=['gender'];


public function admin()
    {
        return $this->hasOne('App\Admin');
    }

}
