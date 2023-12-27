@extends('layout')

@section('content')
    <h1>Game Details</h1>

    <div class="game-details-head">
        <img src="{{ asset('team_logos/' . $game->homeTeam->logo_filename) }}" alt="{{ $game->homeTeam->team_name }} Logo" class="team-logo-details">
        <span class="score-details score-home">{{ $homeTeamScore }}</span>
        <span class="vs-text">Final</span>
        <span class="score-details score-away">{{ $awayTeamScore }}</span>
        <img src="{{ asset('team_logos/' . $game->awayTeam->logo_filename) }}" alt="{{ $game->awayTeam->team_name }} Logo" class="team-logo-details">
    </div>

    <h2 class="sheet-header">Game Sheet</h2>
    <table class="game-sheet">
        <thead>
            <tr>
                <th>Player</th>
                <th>Goals</th>
                <th>Assists</th>
                <th>Points</th>
                <th>TOI</th>
                <th>Plus/Minus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($playerStats as $playerStat)
                <tr>
                    <td>{{ $playerStat->player->name }} {{ $playerStat->player->surname }}</td>
                    <td>{{ $playerStat->goals }}</td>
                    <td>{{ $playerStat->assists }}</td>
                    <td>{{ $playerStat->points }}</td>
                    <td>{{ gmdate('i:s', strtotime($playerStat->time_on_ice)) }}</td>
                    <td>{{ $playerStat->plus_minus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
