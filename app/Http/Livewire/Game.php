<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Player;
use App\Game as GameObj;

class Game extends Component
{
    public $state;
    public $players;
    public $currentPlayer;
    public $currentCard;
    public $drawnCard;
    public $cardsRemaining;
    public $yourTurn = false;
    public $playerName;
    public $cardMessage;
    public $localMessage;
    public $playerId;
    public $gameId;
    protected $player;
    protected $game;


    public function drawCard()
    {
        self::refeshGame();
        if ($this->currentPlayer->id == $this->playerId) {
            $player = Player::find($this->playerId);
            $this->drawnCard = $player->drawCard();
            $this->cardMessage = $player->name.' drew '.$this->drawnCard->value;
            $this->cardsRemaining = $player->game->remainingCards()->count();
            $player->game->updateState('drawn-waiting');
        }
    }

    public function nextTurn()
    {
        $game = GameObj::find($this->gameId);
        $game->updateState('ready-to-draw');
        $game->nextPlayer();
    }

    public function mount($game, $player)
    {
        $this->gameId = $game->id;
        $this->playerId = $player->id;
        $this->players = $game->players;
        $this->game = $game;
        $this->state = $game->state;

        $this->playerName = $player->name;
        $this->currentPlayer = Player::find($game->current_players_turn_id);

        $this->cardsRemaining = $game->remainingCards()->count();

        if ($this->game->players->first()) {
            $this->leader = $this->game->players->first();
        }
        self::refeshGame();
    }

    public function refeshGame()
    {
        $game = GameObj::find($this->gameId);
        $this->currentPlayer = $game->currentPlayer();
        $this->cardsRemaining = $game->remainingCards()->count();
        $this->drawnCard = $game->currentCard();
        $this->state = $game->state;
    }

    public function render()
    {
        return view('livewire.game');
    }
}
