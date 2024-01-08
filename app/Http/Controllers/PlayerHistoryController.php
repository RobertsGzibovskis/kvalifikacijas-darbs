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
    $teams = Team::all();
    $playerHistory = PlayerHistory::with('season', 'team')->get();

    return view('players.create_his', compact('playerHistory','seasons', 'playerId', 'teams'));
}

   public function store(Request $request)
   {

       $formFields2 = $request->validate([
               'player_id' => 'required',
               'team_id' => 'required|exists:teams,team_id',
               'jersey_number' => 'required|integer',
               'season_id' => 'required'
           ]);

           // Iegūstam komandas ID no pieprasījuma un pievienojam to formFields2 masīvam
           $teamID= $request->input('team_id');
           $formFields2['team_id'] = $teamID;

           //Iegūstam sezonas ID no pieprasījuma un pievienojam to formFields2 masīvam
           $seasonId = $request->input('season_id');
           $formFields2['season_id'] = $seasonId;

        PlayerHistory::create($formFields2);

        return redirect('/players')->with('success', 'Player history created successfully!');
        }
}

