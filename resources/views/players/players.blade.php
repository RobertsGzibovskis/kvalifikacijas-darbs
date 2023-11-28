@extends('layout')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Player List</title>
</head>
<body>
    <div class="player-background">
    <h1>Players</h1>
    <div class="flash-message-container">
        @if(session('success'))
          <div id="flash-message" class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
      </div>
    @if (auth()->check() && auth()->user()->isAdmin)
    <a class="create-player-link" href="/players/create">Create player</a>
    @else
    @endif
    <form class="search-form" action="{{ route('searchPlayers') }}" method="POST">
        @csrf
        <div class="search-input-container">
            <input type="text" name="search" placeholder="Search for players..." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </div>
    </form>


    <div class="player-container">
    <div class="player-grid">
                @foreach ($players as $player)
                @php
                $playerHistory = \App\Models\PlayerHistory::where('player_id', $player->player_id)->first();
            @endphp
                   <div class="player-card">
                    <div class="player-info">
                        <img src="{{ asset('players_images/' . $player->image_name) }}" alt="{{ $player->name }}" class="player-image">
                        <p><a href="{{ route('players.showHistory', ['playerId' => $player->player_id]) }}"><span class="player-name">{{ $player->name }} {{ $player->surname }}</span></a></p>
                        <p>#{{ $playerHistory->jersey_number }} | {{ $player->position }} | {{ $playerHistory->team->team_name }}</p>

                        @auth
                        <form method="POST" action="{{ route('users.addFavoritePlayer', ['player' => $player->player_id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Set as Favorite Player</button>
                        </form>
                    @endauth

                    @if (auth()->check() && auth()->user()->isAdmin)
                    <form method="POST" action="{{ route('player.destroy', $player->player_id) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this player?')">Delete</button>
                    </form>
                    @else
                  @endif

                    </div>
                </div>



        @endforeach
    </div>
</div>
    </div>
</body>
</html>
@endsection

