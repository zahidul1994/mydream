<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    protected $fillable = [
 'id', 'name', 'guard_name',
    ];
}
