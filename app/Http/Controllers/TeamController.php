<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\PlayerHistory;
use App\Models\Game;
use App\Models\Player;
use App\Models\PlayerGameStatistics;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::paginate(6);

        return view('teams/teams', compact('teams'));
    }

    public function create()
   {
       return view('teams.create');
   }

   public function store(Request $request)
   {
     $formFields = $request->validate([
        'team_name' => 'required',
        'logo_filename' => 'required'
     ],
     [
         'team_name.required' => 'The name field is required.',
        'logo_filename.required' => 'The logo file name field is required.'
     ]);

     $team = Team::create($formFields);

     return redirect('/teams')->with('success', 'Team created successfully');
   }

   public function destroy(Team $team)
   {

    PlayerHistory::where('team_id', $team->team_id)->delete();

    $gameIds = Game::where('home_team_id', $team->team_id)
        ->orWhere('away_team_id', $team->team_id)
        ->pluck('game_id');

    PlayerGameStatistics::whereIn('game_id', $gameIds)->delete();

    Game::where('home_team_id', $team->team_id)
    ->orWhere('away_team_id', $team->team_id)
    ->delete();

    $team->delete();

       return redirect('/teams')->with('success', 'Team deleted successfully');
   }
}

