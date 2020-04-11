<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Card;

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

    public function start()
    {
        $this->status = 'in-progress';
        $this->save();
        $this->createCards();

        return true;
    }

    public function createCards()
    {
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $suits  = ['S', 'H', 'D', 'C'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $card = new Card;
                $card->value = $value . $suit;
                $card->game_id = $this->id;
                $card->save();
            }
        }

        return $this->cards;
    }

    public function remainingCards()
    {
        return $this->cards->where('player_id', null);
    }

    public function end()
    {
        $this->status = 'ended';
        $this->save();
        return 'ended';
    }
}
