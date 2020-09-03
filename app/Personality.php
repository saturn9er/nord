<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personality extends Model
{
    public function document_type()
    {
        return $this->belongsTo('App\DocumentType');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Passenger');
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }
}
