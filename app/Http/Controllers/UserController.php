<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Team;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.all', compact('users'));
    }


    //Register parādīt
    public function create()
   {
       return view('users.register');
   }

   //Register store
   public function store(Request $request)
   {
    $formFields = $request->validate([
        'name' => 'required',
        'username' => ['required', Rule::unique('users', 'username')],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'password' => 'required|confirmed|min:8'
       ],
       [
        'name.required' => 'The name field is required.',
        'username.required' => 'The username field is required.',
        'username.unique' => 'The username has already been taken.',
        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'password.required' => 'The password field is required.',
    ]);

    //Paroles hashoshana
    $formFields['password'] = bcrypt($formFields['password']);

    //Izveido lietotāju
    $user = User::create($formFields);

    //Log in
    auth()->login($user);

    return redirect('/')->with('message', 'User created and logged in');
   }

   //Logout metode
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //Login metode
    public function login(){
        return view('users.login');
    }

    //Autentifikācija
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
           ],
           [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);
        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            return redirect('/')->with('message', "You are logged in!");
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function show($id)
    {
        $user = auth()->user();
        return view('users.show', compact('user'));
    }


    //Rediģēt lietotāja profilu view
    public function edit($id)
    {
        // Fetch the user details based on the $id parameter
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }


   //Atjauno lietotāja profila informāciju
   public function update(Request $request, User $user)
   {
       $formFields = $request->validate([
           'name' => 'nullable',
           'username' => ['nullable', Rule::unique('users', 'username')],
           'email' => 'nullable|email|unique:users,email,' . $user->id,
           'password' => 'nullable|confirmed|min:8',
       ],
       [
           'email.unique' => 'The email has already been taken.',
           'username.unique' => 'The username has already been taken.',
           'password.min' => 'The password must be at least :min characters.',
       ]);

       // Remove null or empty values from the formFields
       $formFields = array_filter($formFields, function ($value) {
           return $value !== null && $value !== '';
       });

       // Hash the password if provided
       if (isset($formFields['password'])) {
           $formFields['password'] = bcrypt($formFields['password']);
       }

       $user->update($formFields);

       return redirect("/users/{$user->id}/show")->with('message', 'Profile has been edited!');
   }


public function favoriteTeam()
{
    return $this->belongsTo(Team::class, 'favorite_team_id');
}

public function addFavoriteTeam(\App\Models\Team $team)
{
    $user = auth()->user();
    $user->update(['favorite_team_id' => $team->team_id]);
    return redirect('/users/{id}/show')->with('message', 'Favorite team added successfully.');
}

public function favoritePlayer()
{
    return $this->belongsTo(Player::class, 'favorite_player_id');
}

public function addFavoritePlayer(\App\Models\Player $player)
{
    $user = auth()->user();
    $user->update(['favorite_player_id' => $player->player_id]);
    return redirect('/users/{id}/show')->with('message', 'Favorite player added successfully.');
}

public function destroy(User $user)
{
    $user->delete();

    return redirect('/')->with('success', 'User deleted successfully');
}

}

