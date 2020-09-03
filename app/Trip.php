<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function seat()
    {
        return $this->hasMany('App\Seat');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function route()
    {
        return $this->belongsTo('App\Route');
    }
}
