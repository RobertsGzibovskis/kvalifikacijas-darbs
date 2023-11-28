

@extends('layout')

@section('content')
    <h1>Game Details</h1>

    <div>
        <p>Game ID: {{ $game->game_id }}</p>
        <p>Start Time: {{ $game->start_time }}</p>
        <p>Date: {{ $game->date }}</p>
        <p>Home Team: {{ $game->homeTeam->team_name }}</p>
        <p>Away Team: {{ $game->awayTeam->team_name }}</p>
        <!-- Add more details as needed -->
    </div>
@endsection
