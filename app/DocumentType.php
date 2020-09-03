<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public function personality()
    {
        return $this->hasMany('App\Personality');
    }
}
