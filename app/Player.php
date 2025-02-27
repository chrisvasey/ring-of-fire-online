<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    public function drawCard()
    {
        //Get a random card from the ons remaining;
        $card = $this->game->remainingCards()->shuffle()->first();
        if ($card) {
            $card->player_id = $this->id;
            $card->save();
            $this->game->latest_card_id = $card->id;
            $this->game->save();
            return $card;
        }
        return $this->game->end();
    }

    public function turnCheck()
    {
        if ($this->game->current_players_turn_id == $this->id) {
            return true;
        }
        return false;
    }
}
