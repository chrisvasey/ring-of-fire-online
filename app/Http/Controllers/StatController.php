<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Card;

class StatController extends Controller
{
    public function index()
    {
        $gamesPlayed = Game::where('status', '!=', 'new')->get();
        $gamesCount = $gamesPlayed->count();

        $playerCount = 0;
        foreach ($gamesPlayed as $game) {
            $playerCount += $game->players->count();
        }

        $cardsPulled = Card::where('player_id', '!=', null)->get()->count();

        return view('stats', compact('gamesCount', 'playerCount', 'cardsPulled'));
    }
}
