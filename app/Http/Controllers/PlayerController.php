<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\PlayerHistory;

class PlayerController extends Controller
{

    //Player tabula
    public function index()
    {
        $players = Player::all();
        // $players = Player::with('playerHistory.team')->get();

        return view('players/players', compact('players'));
    }

    //Player meklēšana
    public function searchPlayers(Request $request)
{
    $search = $request->input('search'); // Get the search input from the request

    $players = Player::whereRaw('LOWER(name) LIKE ?', [strtolower("$search%")])
    ->orWhereRaw('LOWER(surname) LIKE ?', [strtolower("$search%")])
    ->get();

    return view('players/players', ['players' => $players]);
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

// Retrieve the ID of the player you just created
$playerId = $player->id;

return redirect()->route('history.create', ['playerId' => $playerId])->with('success', 'Player created successfully');
}

public function destroy(Player $player)
   {

    $player->playerHistory()->delete();

    $player->delete();

    return redirect('/players')->with('success', 'Player deleted successfully');
   }

}
