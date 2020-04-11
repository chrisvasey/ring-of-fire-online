<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public $state;
    public $players;
    public $currentPlayer;
    public $currentCard;
    public $cardsRemaining;
    public $playerName;
    public $cardMessage = "Click card to draw..";
    protected $player;
    protected $game;


    public function drawCard()
    {
        # code...
    }

    public function startTurn()
    {
        # code...
    }

    public function checkTurn()
    {
        # code...
    }

    public function mount($game, $player)
    {
        $this->gameId = $game->id;
        $this->game = $game;
        $this->players = $game->players;

        $this->playerName = $player->name;

        $this->cardsRemaining = $game->remainingCards()->count();

        if ($this->game->players->first()) {
            $this->leader = $this->game->players->first();
        }

        // self::checkIfGameStarted();
    }

    public function render()
    {
        return view('livewire.game');
    }
}
