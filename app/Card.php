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

    public function instructions()
    {
        switch ($this->number) {
            case '2':
                return '2 is you. You can choose someone to drink.';
                break;
            case '3':
                return '3 is me. You drink.';
                break;
            case '4':
                return "4 is.... well, female players drink.";
                break;
            case '5':
                return "5 is thumb master. cover your webcam with your thumb whenever you want. The last person to do this must drink. If the player who pulls it isn't on webcam, they must drink.";
                break;
            case '6':
                return "6 is dicks. All male players must drink.";
                break;
            case '7':
                return "7 is heaven. You can point to the sky, the last player who does this has to drink. If you aren't playing on web cam, say heaven at anytime, the last player to say it must drink.";
                break;
            case '8':
                return "8 is mate. Choose another player, they must drink whenever you do.";
                break;
            case '9':
                return "9 is rhyme. think of a word, the next player (based on the turn list) must come up with a word to rhyme with this, go through the list. The first player who can't drink.";
            case '10':
                return "10 is Categories. Pick a category such as football and you go in a circle and everyone has to say a word that fits with football such as: goal, post, player. Whoever messes up, drinks.";
                break;
            case 'J':
                return "Jack is make a rule. You can make up any rule that everyone has to follow, such as you can only drink with your left hand. Everyone (including you) must follow this rule for the whole entire game and if you disobey you must drink.";
                break;
            case 'Q':
                return "Queen is question master. Until someone next pulls this card, anyone who answers a question you ask must drink.";
                break;
            case 'K':
                return "This one is hard to do online, you must do a forfeit decided by the player with the turn before you.";
                break;
            case 'A':
                return "Ace is Waterfall. Everyone should keep drinking until the person who picked the card stops. If you are only on voice, the person who pulled this card must say start when they start to drink and stop then they stop.";
                break;
        }
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
