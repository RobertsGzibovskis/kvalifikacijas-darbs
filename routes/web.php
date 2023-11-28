<?php

use Illuminate\Support\Facades\Route;
use App\Models\Player;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Playeru routes
Route::get('/players', [PlayerController::class, 'index'])->middleware('auth');



Route::get('/players/playerhis', [PlayerHistoryController::class, 'index']);


//Playeru meklēšana
Route::post('/search-players', 'App\Http\Controllers\PlayerController@searchPlayers')->name('searchPlayers');

//Playeru veidošana
Route::get('players/create', [PlayerController::class, 'create'])->middleware('admin');

//Playeru saglabāšana (store)
Route::post('/players', [PlayerController::class, 'store']);

Route::get('/players/create/history', [PlayerHistoryController::class, 'create'])->name('history.create')->middleware('admin');;

Route::post('/players/create/history', [PlayerHistoryController::class, 'store'])->name('history.store')->middleware('admin');;

//Viena playera history routes
Route::get('/players/{playerId}/history', [PlayerHistoryController::class, 'showHistory'])->name('players.showHistory');

//Player delete
Route::delete('/players/{player}', [PlayerController::class, 'destroy'] )->name('player.destroy');

/***********************************************LIETOTĀJU ROUTES********************************************** */
//Lietotāja reģistrēšanās
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Lietotāja izveidošana
Route::post('/users', [UserController::class, 'store']);

//Lietotāja logout
Route::post('/logout', [UserController::class, 'logout']);

//Lietotāja login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');;

//Lietotāja autentifikācija
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Visu lietotāju view
Route::get('/users/all', [UserController::class, 'index'])->middleware('admin');

//Lietotāja profila view
Route::get('/users/{user}/show', [UserController::class, 'show'])->middleware('auth');

//Lieotāja edit view
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');

//Lietotāja profila rediģēšanas update
Route::put('/users/{user}', [UserController::class, 'update']);

//Lietotāja mīļākās komandas izvēle
Route::middleware('auth')->post('/users/add-favorite-team/{team}', [UserController::class, 'addFavoriteTeam'])->name('users.addFavoriteTeam');

//Lietotāja mīļakā spēlētāja izvēle
Route::middleware('auth')->post('/users/add-favorite-player/{player}', [UserController::class, 'addFavoritePlayer'])->name('users.addFavoritePlayer');

//Lietotāja delete
Route::delete('/users/{user}', [UserController::class, 'destroy'] )->name('users.destroy');

/************************************************TEAM ROUTES****************** */
//Team routes
Route::get('/teams', [TeamController::class, 'index'])->middleware('auth');

//Create team view routes
Route::get('teams/create', [TeamController::class, 'create'])->middleware('admin');

//Create team
Route::post('/teams', [TeamController::class, 'store']);

//Delete team
Route::delete('/teams/{team}', [TeamController::class, 'destroy'] )->name('teams.destroy');


/***********************************************NAVBAR ROUTES****************************** */
//Navigation bar route
Route::get('/nav/{id}', function ($id) {
    return response($id);
});

/********************************************GAME ROUTES****************************************/

//Game routes
Route::get('/games', [GameController::class, 'index'])->name('games.index');

//Vienas game routes
Route::get('/games/{game_id}', [GameController::class, 'showDetails'])->name('game.details');
