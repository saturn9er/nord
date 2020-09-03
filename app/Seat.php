<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function trips()
    {
        return$this->belongsTo('App\Trip');
    }
}
