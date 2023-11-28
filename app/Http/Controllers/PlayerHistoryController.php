<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerHistory;
use App\Models\Player;
use App\Models\Season;

class PlayerHistoryController extends Controller
{
    public function showHistory($playerId)
{
    $player = Player::find($playerId);
    $playerHistory = PlayerHistory::where('player_id', $playerId)->get();

    return view('/players/playershis', compact('player', 'playerHistory'));
}

public function create()
{
    $seasons = Season::all();
    $playerHistory = PlayerHistory::with('season', 'team')->get();

    return view('players.create_his', compact('playerHistory','seasons'));;
}

   public function store(Request $request)
   {
       // Check if the form submission is intended for PlayerHistoryController

       $formFields2 = $request->validate([
               'player_id' => 'required',
               'team_id' => 'required',
               'jersey_number' => 'required',
               'season_id' => 'required'
           ]);

           $seasonId = $request->input('season_id');

    // Add the season_id to the form fields
    $formFields2['season_id'] = $seasonId;



           PlayerHistory::create($formFields2);

           return redirect('/players')->with('success', 'Player history created successfully');
        }
}

