<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $fillable=[
      'status'

  ];
   public function admin()
    {
        return $this->hasOne('App\Admin');
    }
     
}
