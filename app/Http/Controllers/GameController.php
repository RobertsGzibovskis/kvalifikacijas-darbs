<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Season;
use App\Models\PlayerGameStatistics;
use App\Models\TeamParticipation;

class GameController extends Controller
{
    public function index()
{



    $games = Game::orderByRaw("CASE WHEN game_status = 'Final' THEN 1 ELSE 0 END DESC")
        ->orderBy('date')
        ->paginate(6);


        foreach ($games as $game) {
            $homeTeamScore = 0;
            $awayTeamScore = 0;

        // Assuming getPlayerGameStatistics is a method in your Game model
        $playerStats = $game->getPlayerGameStatistics();

        foreach ($playerStats as $playerStat) {
            $player = $playerStat->player;
            $teamId = optional($player->playerHistory)->team_id;

            $playerStat->team_id = $teamId;

            if ($game->home_team_id == $teamId) {
                $homeTeamScore += $playerStat->goals;
            } else if ($game->away_team_id == $teamId){
                $awayTeamScore += $playerStat->goals;
            }
        }

        $game->homeTeamScore = $homeTeamScore;
        $game->awayTeamScore = $awayTeamScore;
    }

    return view('games.games', compact('games', 'homeTeamScore', 'awayTeamScore'));
}

    public function showDetails($game_id, $team = null)
    {
        $game = Game::findOrFail($game_id);

        $homeTeamScore = 0;
        $awayTeamScore = 0;


        // Retrieve player statistics for the given game
        $playerStats = $game->getPlayerGameStatistics();


        foreach ($playerStats as $playerStat) {
            $player = $playerStat->player;
            $teamId = optional($player->playerHistory)->team_id;
            // You can now use $teamId as needed, for example, you might add it to the $playerStat object
            $playerStat->team_id = $teamId;

            if($game->home_team_id == $teamId)
            {
                $homeTeamScore += $playerStat->goals;
            }
            else if ($game->away_team_id == $teamId) {
                $awayTeamScore += $playerStat->goals;
            }
        }

        // Pass both $game and $playerStats to the view
        return view('games.details', compact('game', 'playerStats', 'homeTeamScore', 'awayTeamScore'));
    }




public function create()
{
    $teams = Team::all();
    $seasons = Season::all();
    return view('games.create', compact('teams', 'seasons'));
}

    public function store(Request $request)
    {
        $customMessages = [
            'start_time.date_format' => 'The start time must be in the HH:MM format.',

        ];

        $formFields = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'date' => 'required',
            'game_status' => 'required',
            'home_team_id' => 'required',
            'away_team_id' => 'required',
            'winning_team_id' => 'nullable',
            'home_team_shots_on_goal' => 'nullable|integer',
            'away_team_shots_on_goal' => 'nullable|integer',
            'blocks' => 'nullable|integer',
            'power_play_count' => 'nullable|integer',
            'season_id' => 'required',
            // Add more validation rules as needed
        ], $customMessages);

        $homeId = $request->input('home_team_id');

        $awayId = $request->input('away_team_id');

        $winId = $request->input('winning_team_id');

        $seasonId = $request->input('season_id');

        $formFields['home_team_id'] = $homeId;
        $formFields['away_team_id'] = $awayId;
        $formFields['winning_team_id'] = $winId;
        $formFields['season_id'] = $seasonId;

        if ($request->input('game_status') === 'Final') {
            $formFields['winning_team_id'] = $request->input('winning_team_id');
        } else {
            $formFields['winning_team_id'] = null;
        }

        $game = Game::create($formFields);

        TeamParticipation::create([
            'team_id' => $homeId,
            'game_id' => $game->game_id,
        ]);

        TeamParticipation::create([
            'team_id' => $awayId,
            'game_id' => $game->game_id,
        ]);


        return redirect('/games');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $teams = Team::all();

        return view('games.edit', compact('game', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        // Validate and update the game data
        $formFields = $request->validate([
            'game_status' => 'required',
            'winning_team_id' => 'nullable',
            'home_team_shots_on_goal' => 'nullable|integer',
            'away_team_shots_on_goal' => 'nullable|integer',
            'blocks' => 'nullable|integer',
            'power_play_count' => 'nullable|integer',
            // Add more validation rules as needed
        ]);

        $formFields = array_filter($formFields, function ($value) {
            return $value !== null;
        });

        $winId = $request->input('winning_team_id');
        $formFields['winning_team_id'] = $winId;

        if ($request->input('game_status') === 'Final') {
            $formFields['winning_team_id'] = $request->input('winning_team_id');
        } else {
            $formFields['winning_team_id'] = null;
        }

        $formFields['winning_team_id'] = $winId;

        $game->update($formFields);

        return redirect('/games')->with('success', 'Game edited successfully!');
    }

    public function destroy($gameId)
{
    // Find the game
    $game = Game::findOrFail($gameId);

    $game->playerStatistics()->delete();

    TeamParticipation::where('game_id', $gameId)->delete();

    // Delete the game
    $game->delete();

    // Redirect or respond as needed
    return redirect('/games')->with('success', 'Game deleted successfully');
}
}
