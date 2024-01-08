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
    // Izvēlamies visus spēļu ierakstus no "games" tabulas
    // Kārtojam pēc diviem kritērijiem:
    // 1. Pēc "game_status" vērtības, kur "Final" iet priekšā, citi nāk aiz tam
    // 2. Pēc "date" kolonnas augošā secībā (ja divas spēles ir ar vienādu "game_status")
    $games = Game::orderByRaw("CASE WHEN game_status = 'Final' THEN 1 ELSE 0 END DESC")
        ->orderBy('date')
        ->paginate(6);

       // Iterējam cauri katrai spēlei
        foreach ($games as $game) {
            $homeTeamScore = 0;
            $awayTeamScore = 0;

        // Iegūstam spēlētāju statistiku konkrētajai spēlei
        $playerStats = $game->getPlayerGameStatistics();
          // Iterējam cauri katram spēlētājam un aprēķinam komandu rezultātus
        foreach ($playerStats as $playerStat) {
            $player = $playerStat->player;
            $teamId = optional($player->playerHistory)->team_id;

            $playerStat->team_id = $teamId;
          // Pārbauda, vai spēlētāja piederība komandai sakrīt ar spēles mājas komandu
           // Ja spēlētājs pieder mājas komandai, pievieno guvumu mājas komandai
           // Ja spēlētājs pieder viesu komandai, pievieno guvumu viesu komandai
            if ($game->home_team_id == $teamId) {
                $homeTeamScore += $playerStat->goals;
            } else if ($game->away_team_id == $teamId){
                $awayTeamScore += $playerStat->goals;
            }
        }
          // Pievienojam aprēķinātos rezultātus pašai spēlei
        $game->homeTeamScore = $homeTeamScore;
        $game->awayTeamScore = $awayTeamScore;
    }
    // Atgriežam skatu ar spēlēm, kā arī rezultātu mainīgajiem
    return view('games.games', compact('games', 'homeTeamScore', 'awayTeamScore'));
}
    //Šai funkcijai tāda pati loģika kā index() funkcijai, lai aprēķinātu spēles rezultātu
    public function showDetails($game_id, $team = null)
    {
        $game = Game::findOrFail($game_id);

        $homeTeamScore = 0;
        $awayTeamScore = 0;

        $playerStats = $game->getPlayerGameStatistics();


        foreach ($playerStats as $playerStat) {
            $player = $playerStat->player;
            $teamId = optional($player->playerHistory)->team_id;

            $playerStat->team_id = $teamId;

            if($game->home_team_id == $teamId)
            {
                $homeTeamScore += $playerStat->goals;
            }
            else if ($game->away_team_id == $teamId) {
                $awayTeamScore += $playerStat->goals;
            }
        }

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
  // Pārbauda un iegūst formas laukus
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
        ], $customMessages);

       // Iegūst nepieciešamos datus no pieprasījuma
        $homeId = $request->input('home_team_id');

        $awayId = $request->input('away_team_id');

        $winId = $request->input('winning_team_id');

        $seasonId = $request->input('season_id');

        // Pievieno izvēlētos datus formu laukiem
        $formFields['home_team_id'] = $homeId;
        $formFields['away_team_id'] = $awayId;
        $formFields['winning_team_id'] = $winId;
        $formFields['season_id'] = $seasonId;

        // Nosacījums par uzvarētās komandas norādīšanu, ja spēles status ir 'Final'
        if ($request->input('game_status') === 'Final') {
            $formFields['winning_team_id'] = $request->input('winning_team_id');
        } else {
            $formFields['winning_team_id'] = null;
        }

        $game = Game::create($formFields);

        // Izveido ierakstus komandu dalībai spēlē
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


        $formFields = $request->validate([
            'game_status' => 'required',
            'winning_team_id' => 'nullable',
            'home_team_shots_on_goal' => 'nullable|integer',
            'away_team_shots_on_goal' => 'nullable|integer',
            'blocks' => 'nullable|integer',
            'power_play_count' => 'nullable|integer',
        ]);

         // Filtrējam izveidotos laukus, lai noņemtu null vērtības
        $formFields = array_filter($formFields, function ($value) {
            return $value !== null;
        });

        $winId = $request->input('winning_team_id');
        $formFields['winning_team_id'] = $winId;

          // Nosacījums par uzvarētās komandas norādīšanu, ja spēles status ir 'Final'
        if ($request->input('game_status') === 'Final') {
            $formFields['winning_team_id'] = $request->input('winning_team_id');
        } else {
            $formFields['winning_team_id'] = null;
        }

        $formFields['winning_team_id'] = $winId;
        // Atjaunojam spēles datus ar jaunajiem laukiem
        $game->update($formFields);

        return redirect('/games')->with('success', 'Game edited successfully!');
    }

    public function destroy($gameId)
{
      // Atrod spēli ar norādīto ID
    $game = Game::findOrFail($gameId);
       // Dzēš saistīto spēlētāju statistikas, izmantojot attiecību, kas definēta Game modelī
    $game->playerStatistics()->delete();
    // Dzēš komandas dalību, kas saistīta ar šo spēli
    TeamParticipation::where('game_id', $gameId)->delete();
    // Dzēš pašu spēli
    $game->delete();

    return redirect('/games')->with('success', 'Game deleted successfully');
}
}
