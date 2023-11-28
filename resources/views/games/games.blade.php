<!-- resources/views/games/index.blade.php -->

@extends('layout')

@section('content')
    <h1>Games</h1>

    <div class="game-container">
        <div class="game-grid">
            @foreach ($games as $game)
            <div class="game-card {{ today()->isSameDay($game->date) && auth()->check() && auth()->user()->isAdmin ? 'today-game' : '' }}">

                    <div class="team-logos">
                        <div class="team-logo">
                            <img src="{{ asset('team_logos/' . $game->homeTeam->logo_filename) }}" alt="{{ $game->homeTeam->team_name }} Logo">
                        </div>
                        @if ($game->home_team_score !== null && $game->away_team_score !== null)
                        <div class="score">
                            <span>{{ $game->home_team_score }}</span>
                            <span>:</span>
                            <span>{{ $game->away_team_score }}</span>
                        </div>
                    @else
                    <div class="game-time-date">
                    <div class="game-time">
                        {{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }}
                    </div>
                    <div class="game-date">
                        {{ \Carbon\Carbon::parse($game->date)->format('m/d') }}
                    </div>
                    </div>
                    @endif
                        <div class="team-logo">
                            <img src="{{ asset('team_logos/' . $game->awayTeam->logo_filename) }}" alt="{{ $game->awayTeam->team_name }} Logo">
                        </div>
                    </div>
                    <div class="game-info">
                        <p>{{ $game->homeTeam->team_name }}    {{ $game->awayTeam->team_name }}</p>
                        <p>{{ $game->game_status }}</p>
                    </div>
                    @if ($game->game_status == 'Final')
                <a href="{{ route('game.details', ['game_id' => $game->game_id]) }}" class="game-link">
                    View Game Details
                </a>
            @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
