<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderByRaw("CASE WHEN game_status = 'Final' THEN 1 ELSE 0 END DESC")
        ->orderBy('date')
        ->get();

        return view('games.games', compact('games'));
    }

    public function showDetails($game_id)
{
    $game = Game::findOrFail($game_id);

    // You can pass the $game variable to the view and display the details
    return view('games.details', compact('game'));
}
}
