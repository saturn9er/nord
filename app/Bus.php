<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function trip()
    {
        return $this->hasMany('App\Trip');
    }
}
