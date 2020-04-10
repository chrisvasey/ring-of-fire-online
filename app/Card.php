<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function games()
    {
        return $this->belongsTo('App\Game');
    }

    public function owner()
    {
        return $this->belongsTo('App\Player');
    }
}
