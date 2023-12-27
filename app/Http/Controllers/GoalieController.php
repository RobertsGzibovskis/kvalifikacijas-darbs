<?php

namespace App\Http\Controllers;

use App\Models\Goalie;
use Illuminate\Http\Request;

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
        return view('goalies.create');
    }

    public function store(Request $request)
    {
       $formFields = $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'team_id' => 'required',
        'image_name' => 'required',
        'shutouts'  => 'required',
        'gaa'  => 'required',
        'assists'  => 'required',
        'jersey_number'  => 'required'
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

    $goalie = Goalie::create($formFields);

    return redirect('/goalies')->with('success', 'Goalie created successfully');
}

public function edit($id)
{
    $goalie = Goalie::findOrFail($id);
    return view('goalies.edit', compact('goalie'));
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
        'shutouts' => 'nullable',
        'gaa' => 'nullable',
        'assists' => 'nullable',
        'jersey_number' => 'nullable',
    ]);

    // Filter out null values
    $filteredData = array_filter($validatedData, function ($value) {
        return $value !== null;
    });

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
