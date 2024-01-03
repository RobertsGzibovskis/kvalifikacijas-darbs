<?php

namespace App\Http\Controllers;

use App\Models\Goalie;
use Illuminate\Http\Request;
use App\Models\Team;

class GoalieController extends Controller
{
    public function index()
    {
        $goalies = Goalie::all();
        return view('goalies.goalies', compact('goalies'));
    }

    public function showGoalie($goalieId)
    {
        $goalie = Goalie::find($goalieId);

        return view('goalies.details', compact('goalie'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('goalies.create', compact('teams'));
    }

    public function store(Request $request)
    {
       $formFields = $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'team_id' => 'required',
        'image_name' => 'required',
        'shutouts'  => 'required|integer',
        'gaa'  => 'required',
        'assists'  => 'required|integer',
        'jersey_number'  => 'required|integer'
       ],
       [
        'name.required' => 'The name field is required.',
        'surname.required' => 'The surname field is required.',
        'team_id.required' => 'The team id field is required.',
        'image_name.required' => 'The image name field is required',
        'shutouts.required' => 'The shutouts field is required',
        'gaa.required' => 'The gaa field is required',
        'assists.required' => 'The assists field is required',
        'jersey_number.required' => 'The jersey number field is required'
    ]);

    $teamID= $request->input('team_id');

    $formFields['team_id'] = $teamID;

    $goalie = Goalie::create($formFields);

    return redirect('/goalies')->with('success', 'Goalie created successfully');
}

public function edit($id)
{
    $goalie = Goalie::findOrFail($id);
    $teams = Team::all(); // Assuming you want to retrieve all teams
    return view('goalies.edit', compact('goalie', 'teams'));
}

public function update(Request $request, $id)
{
    $goalie = Goalie::findOrFail($id);

    // Validate the fields
    $validatedData = $request->validate([
        'name' => 'nullable',
        'surname' => 'nullable',
        'team_id' => 'nullable',
        'image_name' => 'nullable',
        'shutouts' => 'nullable|integer',
        'gaa' => 'nullable',
        'assists' => 'nullable|integer',
        'jersey_number' => 'nullable|integer',
    ]);

    // Filter out null values
    $filteredData = array_filter($validatedData, function ($value) {
        return $value !== null;
    });

    $teamID= $request->input('team_id');

    $validatedData['team_id'] = $teamID;

    // Update the goalie with the filtered data
    $goalie->update($filteredData);

    return redirect('/goalies')->with('success', 'Goalie updated successfully!');
}


public function destroy($id)
{
    $goalie = Goalie::findOrFail($id);
    $goalie->delete();

    return redirect('/goalies')->with('success', 'Goalie deleted successfully!');
}
}
