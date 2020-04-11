<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use App\Game;
use App\Player;

class GameController extends Controller
{
    public function new()
    {
        $game = new Game();
        $game->code = substr(uniqid('', true), -5);
        $game->save();

        //Create cards here.

        return redirect('game/'.$game->code);
    }

    public function join($code)
    {
        $game = Game::where('code', $code)->first();

        if (!$game) {
            return Abort(404);
        }

        if ($game->status == 'new') {
            return view('join', compact('game'));
        }

        //If the game has ended, redirect to menu
        if ($game->status == 'ended') {
            return Redirect('/')->with('warning_message', 'This game has ended, started a new one');
        }

        //If the game is in progress
        if ($game->status == 'in-progress') {
            if (request()->cookie($game->code)) {
                $player = Player::find(request()->cookie($game->code));
                if ($player) {
                    return Redirect('/game/'.$game->code.'/play');
                }
            }
            return Redirect('/')->with('warning_message', 'This game has already started, you will have to join the next one');
        }
    }

    public function createPlayerCookie($code, $playerId)
    {
        $minutes = 60;
        $cookie = cookie($code, $playerId, $minutes);
        return Redirect('/game/'.$code)->cookie($cookie);
    }

    public function play($code)
    {
        $game = Game::where('code', $code)->first();

        if (!$game) {
            return Abort(404);
        }

        //If the game has not started, redirect to join screen
        if ($game->status == 'new') {
            return Redirect('/game/'.$game->code);
        }

        //If the game has ended, redirect to menu
        if ($game->status == 'ended') {
            return Redirect('/')->with('warning_message', 'This game has ended, started a new one');
        }

        //If the game is in progress
        if ($game->status == 'in-progress') {
            if (request()->cookie($game->code)) {
                $player = Player::find(request()->cookie($game->code));
                if (!$player) {
                    return Redirect('/')->with('warning_message', 'This game has already started, you will have to join the next one');
                }
                return view('game', compact('game', 'player'));
            }
            return Redirect('/')->with('warning_message', 'This game has already started, you will have to join the next one');
        }
    }
}
