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
        $this->current_players_turn_id = $this->players->first()->id;
        $this->save();
        $this->createCards();

        return true;
    }

    public function nextPlayer()
    {
        $nextPlayer = null;
        $found = false;
        foreach ($this->players as $player) {
            if ($found) {
                $nextPlayer = $player;
            }
            if ($player->id  == $this->current_players_turn_id) {
                $found = true;
            }
        }

        if (!$nextPlayer) {
            $nextPlayer = $this->players->first();
        }

        $this->current_players_turn_id = $nextPlayer->id;
        $this->save();

        return $nextPlayer;
    }

    public function updateState($state)
    {
        $this->state = $state;
        if ($state == 'ended') {
            $this->status = 'ended';
        }
        $this->save();
    }

    public function currentPlayer()
    {
        return $this->players->where('id', $this->current_players_turn_id)->first();
    }

    public function currentCard()
    {
        return $this->cards->where('id', $this->latest_card_id)->first();
    }

    public function createCards()
    {
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $suits  = ['S', 'H', 'D', 'C'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $card = new Card;
                $card->suit = $suit;
                $card->number = $value;
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

    public function getAvailableColor()
    {
        $colors = ['black', 'blue', 'cyan', 'yellow', 'orange', 'red', 'green'];
        $usedColors = $this->players->pluck('color')->all();

        return collect(array_diff($colors, $usedColors))->shuffle()->first();
    }
}
