<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerHistory;
use App\Models\Player;
use App\Models\Season;
use App\Models\Team;

class PlayerHistoryController extends Controller
{
    public function showHistory($playerId)
{
    $player = Player::find($playerId);
    $playerHistory = PlayerHistory::where('player_id', $playerId)->get();

    return view('/players/playershis', compact('player', 'playerHistory'));
}

public function create($playerId)
{
    $seasons = Season::all();
    $teams = Team::all(); // Assuming you want to retrieve all teams
    $playerHistory = PlayerHistory::with('season', 'team')->get();

    return view('players.create_his', compact('playerHistory','seasons', 'playerId', 'teams'));
}

   public function store(Request $request)
   {
       // Check if the form submission is intended for PlayerHistoryController

       $formFields2 = $request->validate([
               'player_id' => 'required',
               'team_id' => 'required|exists:teams,team_id',
               'jersey_number' => 'required|integer',
               'season_id' => 'required'
           ]);

           $teamID= $request->input('team_id');

           $formFields2['team_id'] = $teamID;

           $seasonId = $request->input('season_id');

    // Add the season_id to the form fields
        $formFields2['season_id'] = $seasonId;

        PlayerHistory::create($formFields2);

        return redirect('/players')->with('success', 'Player history created successfully!');
        }
}

