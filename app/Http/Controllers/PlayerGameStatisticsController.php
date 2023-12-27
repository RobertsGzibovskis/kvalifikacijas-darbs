<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerGameStatistics;

class PlayerGameStatisticsController extends Controller
{
    public function show(Game $game)
    {
        // Retrieve player game statistics for the given game
        $playerStats = $game->playerStatistics;



        return view('game.show', compact('game', 'playerStats'));
    }
}
