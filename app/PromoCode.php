<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Passenger', 'id','used_by');
    }
}
