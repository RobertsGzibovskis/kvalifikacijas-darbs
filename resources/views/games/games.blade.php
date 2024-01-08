<!-- resources/views/games/index.blade.php -->

@extends('layout')

@section('content')
    <h1>Games</h1>
    <div class="flash-message-container">
        @if(session('success'))
          <div id="flash-message" class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
      </div>
    @if (auth()->check() && auth()->user()->isAdmin)
    <a class="create-player-link" href="/game/create">Create game</a>
    @else
    @endif
    <div class="game-container">
        <div class="game-grid">
            @foreach ($games as $game)
            <div class="game-card {{ today()->isSameDay($game->date) && auth()->check() && auth()->user()->isAdmin ? 'today-game' : '' }}">

                    <div class="team-logos">
                        <div class="team-logo">
                            <img src="{{ asset('team_logos/' . $game->homeTeam->logo_filename) }}" alt="{{ $game->homeTeam->team_name }} Logo">
                        </div>
                        @if($game->game_status == 'Final')
                        <div class="score">
                            <span>{{ $game->homeTeamScore }}</span>
                            <span>:</span>
                            <span>{{ $game->awayTeamScore }}</span>
                        </div>
                    @else
                    <div class="game-time-date">
                    <div class="game-time">
                         <!-- Attēlojam spēles sākuma laiku, izmantojot Carbon datuma un laika bibliotēku -->
                        {{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }}
                    </div>
                    <div class="game-date">
                         <!-- Attēlojam spēles datumu, izmantojot Carbon datuma un laika bibliotēku -->
                        {{ \Carbon\Carbon::parse($game->date)->format('m/d') }}
                    </div>
                    </div>
                    @endif
                        <div class="team-logo">
                            <img src="{{ asset('team_logos/' . $game->awayTeam->logo_filename) }}" alt="{{ $game->awayTeam->team_name }} Logo">
                        </div>
                    </div>
                    <div class="game-info">
                        <p>{{ $game->homeTeam->team_name }}</p>
                        <p>VS</p>
                        <p>{{ $game->awayTeam->team_name }}</p>
                    </div>
                    @if ($game->game_status == 'Final')
                <a href="{{ route('game.details', ['game_id' => $game->game_id]) }}" class="game-link">
                    View Game Details
                </a>
            @endif
            @if (auth()->check() && auth()->user()->isAdmin)
            <button class="edit-game" onclick="location.href='{{ route('game.edit', ['game_id' => $game->game_id]) }}'">Edit Game</button>
            <form method="POST" action="{{ route('game.destroy', ['game_id' => $game->game_id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Delete Game</button>
            </form>
            @else
            @endif
                </div>
            @endforeach
        </div>
    </div>
    {{ $games->links() }}
@endsection
