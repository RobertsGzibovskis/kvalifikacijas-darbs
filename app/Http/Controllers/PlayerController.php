<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\PlayerHistory;
use App\Models\PlayerGameStatistics;

class PlayerController extends Controller
{

    //Player tabula
    public function index(Request $request)
    {

        $search = $request->input('search');

        $players = Player::paginate(6);
        // $players = Player::with('playerHistory.team')->get();

        return view('players/players', compact(['players', 'search']));
    }

    //Player meklēšana
    public function searchPlayers(Request $request)
{
    $search = $request->input('search'); // Get the search input from the request

    $players = Player::whereRaw('LOWER(name) LIKE ?', [strtolower("$search%")])
    ->orWhereRaw('LOWER(surname) LIKE ?', [strtolower("$search%")])
    ->paginate(6);

    $players->appends(['search' => $search]);

    return view('players/players', ['players' => $players,'search' => $search]);
}

   //Player veidošana

   public function create()
   {
       return view('players.create');
   }

   //Player saglabāšana (store)
   public function store(Request $request)
{
   $formFields = $request->validate([
    'name' => 'required',
    'surname' => 'required',
    'position' => 'required',
    'image_name' => 'required'
   ],
   [
    'name.required' => 'The name field is required.',
    'surname.required' => 'The surname field is required.',
    'position.required' => 'The position field is required.',
    'image_name.required' => 'The image_name field is required'
]);

$player = Player::create($formFields);


$playerId = $player->player_id;

return redirect()->route('history.create', ['playerId' => $playerId])->with('success', 'Player created successfully');
}


 //Spēlētāja edit view atgriešana
public function edit($id)
{
    $player = Player::findOrFail($id);
    return view('players.edit', compact('player'));
}


 //Spēlētāja update funkcija
 public function update(Request $request, $id)
 {
     $player = Player::findOrFail($id);

     // Validate the fields
     $validatedData = $request->validate([
         'name' => 'nullable',
         'surname' => 'nullable',
         'team_id' => 'nullable',
         'image_name' => 'nullable',
         'position' => 'nullable',
         // Add other fields as needed
     ]);

     // Filter out null values
     $filteredData = array_filter($validatedData, function ($value) {
         return $value !== null;
     });

     // Update the player with the filtered data
     $player->update($filteredData);

     return redirect('/players')->with('success', 'Player updated successfully!');
 }




public function destroy(Player $player)
   {

    $player->playerGameStatistics()->delete();

    $player->playerHistory()->delete();

    \DB::table('users')->where('favorite_player_id', $player->player_id)->update(['favorite_player_id' => null]);


    $player->delete();

    return redirect('/players')->with('success', 'Player deleted successfully');
   }

}

