<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use App\Game;

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

    public function view($code)
    {
        $game = Game::where('code', $code)->first();

        if (!$game) {
            return Abort(404);
        }

        if ($game->status == 'new') {
            return view('join', compact('game'));
        }
    }
    public function createPlayerCookie($code, $playerId)
    {
        $minutes = 60;
        $cookie = cookie($code, $playerId, $minutes);
        return Redirect('/game/'.$code)->cookie($cookie);
    }
}
