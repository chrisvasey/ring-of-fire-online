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
        if ($this->playerName) {
            $player = new Player;
            $player->name = $this->playerName;
            $player->game_id = $this->gameId;
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
        if ($this->gameStarted) {
            return Redirect('/game/'.$this->code.'/play');
        }
    }

    public function changeName()
    {
        $player = Player::find($this->playerId);
        if ($player) {
            $player->name = $this->playerName;
            $player->save();
            return $this->message = "Name Saved!";
        }

        return $this->message = "Name not saved!";
    }

    public function mount(SessionManager $session, $game)
    {
        $this->gameId = $game->id;
        $this->code = $game->code;
        $this->game = $game;

        $this->players = [
            ['name' => 'Chris'],
            ['name' => 'Grace'],
            ['name' => 'jame'],
        ];

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
    public function render()
    {
        return view('livewire.join-game');
    }
}
