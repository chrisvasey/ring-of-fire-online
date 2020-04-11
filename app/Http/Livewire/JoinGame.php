<?php

namespace App\Http\Livewire;

use \Illuminate\Session\SessionManager;
use Livewire\Component;
use Session;

use App\Player;
use App\Game;
use App\Card;

class JoinGame extends Component
{
    public $gameId;
    public $code;
    public $playerName;
    public $playerId;
    public $message;
    public $partyLeader = false;
    public $joined = false;
    public $leader;
    public $gameStarted = false;

    public $players;

    protected $player;
    protected $game;



    public function join(SessionManager $session)
    {
        if (!$this->playerName || strlen($this->playerName) <= 4) {
            return $this->message = "Name must be at least 4 characters long!";
        };
        if ($this->playerName) {
            $game = Game::find($this->gameId);
            $player = new Player;
            $player->name = $this->playerName;
            $player->game_id = $game->id;
            $player->color = $game->getAvailableColor();
            $player->save();
            $this->playerId = $player->id;
        }

        return Redirect('/game/'.$this->code.'/'.$this->playerId);
    }

    public function startGame()
    {
        //Update the game status
        $game = Game::find($this->gameId);
        $game->start();
        $this->message = "The game is starting..";
        $this->gameStarted = true;

        //Check if game has started, redirect
        self::checkIfGameStarted();
    }

    public function checkIfGameStarted()
    {
        if (Game::find($this->gameId)->status == 'in-progress') {
            return Redirect('/game/'.$this->code.'/play');
        }
    }

    public function changeName()
    {
        if (!$this->playerName || strlen($this->playerName) <= 4) {
            return $this->message = "Name must be at least 4 characters long!";
        };
        $player = Player::find($this->playerId);
        if ($player) {
            $player->name = $this->playerName;
            $player->save();
            return $this->message = "Name changed!";
        }

        return $this->message = "Name not changed!";
    }

    public function mount(SessionManager $session, $game)
    {
        $this->gameId = $game->id;
        $this->code = $game->code;
        $this->game = $game;

        $this->players = $game->players;

        if ($this->game->players->first()) {
            $this->leader = $this->game->players->first();
        }

        if (request()->cookie($this->code)) {
            $this->player = Player::find(request()->cookie($this->code));
            if ($this->player) {
                $this->playerId = Player::find(request()->cookie($this->code))->id;
                $this->playerName = $this->player->name;
                $this->joined = true;

                if ($this->game->players->first() && $this->game->players->first()->id == $this->player->id) {
                    $this->partyLeader = true;
                }
            }
        }

        self::checkIfGameStarted();
    }

    public function refreshPlayers()
    {
        $game = Game::find($this->gameId);
        $this->players = $game->players;
        return self::checkIfGameStarted();
    }

    public function clearMessage()
    {
        $this->message = null;
    }

    public function render()
    {
        return view('livewire.join-game');
    }
}
