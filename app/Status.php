<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const SCHEDULED = 1;
    const DELAYED   = 2;
    const BOARDING  = 3;
    const DEPARTED  = 4;
    const ARRIVED   = 5;
    const CANCELLED = 6;
    const NO_INFO   = 7;

    public function trip()
    {
        return $this->hasMany('App\Trip');
    }
}
