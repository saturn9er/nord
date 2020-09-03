<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    public function departure()
    {
        return $this->hasMany('App\Route', 'departure', 'id');
    }

    public function destination()
    {
        return $this->hasMany('App\Route', 'destination', 'id');
    }
}
