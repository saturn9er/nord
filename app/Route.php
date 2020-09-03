<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;

    public function trip()
    {
        return $this->hasMany('App\Trip');
    }

    public function departure()
    {
        return $this->belongsTo('App\Terminal', 'id', 'departure');
    }

    public function destination()
    {
        return $this->belongsTo('App\Terminal', 'id', 'destination');
    }
}
