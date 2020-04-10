<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function games()
    {
        return $this->belongsTo('App\Game');
    }

    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
