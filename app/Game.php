<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }
}
