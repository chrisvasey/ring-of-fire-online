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

    public function prettyValue()
    {
        $suit = null;
        $value = null;

        switch ($this->suit) {
            case 'S':
                $suit = 'Spades';
                break;
            case 'H':
                $suit = 'Hearts';
                break;
            case 'D':
                $suit = 'Diamonds';
                break;
            case 'C':
                $suit = 'Clubs';
                break;
        }

        switch ($this->number) {
            case 'J':
                $value = 'Jack';
                break;
            case 'Q':
                $value = 'Queen';
                break;
            case 'K':
                $value = 'King';
                break;
            case 'A':
                $value = 'Ace';
                break;
            default:
                $value = $this->number;
                break;
        }

        return $value.' of '.$suit;
    }
}
