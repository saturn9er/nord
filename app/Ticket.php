<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function personality()
    {
        return $this->belongsTo('App\Personality');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Passenger');
    }

    public function promo_code()
    {
        return $this->hasOne('App\PromoCode');
    }

    public function seat()
    {
        return $this->hasOne('App\Seat');
    }
}
