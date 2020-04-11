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

    public function joinCode(Request $request)
    {
        if (!$request->code) {
            return Back()->with('error-message', 'You must put in a code');
        }

        $game = Game::where('code', $request->code)->first();

        if (!$game) {
            return Back()->with('error-message', 'No game found with that code, maybe ask for it again?');
        }

        if ($game->status != 'new') {
            return Back()->with('error-message', "This game has already started or finished and can no longer be joined, maybe create a new one if your friends aren't too drunk!");
        }

        if ($game->status == 'new') {
            return Redirect('/game/'.$game->code);
        }
    }

    public function join($code)
    {
        $game = Game::where('code', $code)->first();

        if (!$game) {
            return Redirect('/')->with('error-message', "Couldn't find that game, maybe try making a new one");
        }

        if ($game->status == 'new') {
            return view('join', compact('game'));
        }

        //If the game has ended, redirect to menu
        if ($game->status == 'ended') {
            return Redirect('/')->with('error-message', 'This game has ended, started a new one');
        }

        //If the game is in progress
        if ($game->status == 'in-progress') {
            if (request()->cookie($game->code)) {
                $player = Player::find(request()->cookie($game->code));
                if ($player) {
                    return Redirect('/game/'.$game->code.'/play');
                }
            }
            return Redirect('/')->with('error-message', 'This game has already started, you will have to join the next one');
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
            return Redirect('/')->with('error-message', 'This game has ended, started a new one');
        }

        //If the game is in progress
        if ($game->status == 'in-progress') {
            if (request()->cookie($game->code)) {
                $player = Player::find(request()->cookie($game->code));
                if (!$player) {
                    return Redirect('/')->with('error-message', 'This game has already started, you will have to join the next one');
                }
                return view('game', compact('game', 'player'));
            }
            return Redirect('/')->with('error-message', 'This game has already started, you will have to join the next one');
        }
    }
}
