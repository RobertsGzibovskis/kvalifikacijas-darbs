@extends('layout')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Goalie List</title>
</head>
<body>
    <div class="player-background">
    <h1>Goalies</h1>
    <div class="flash-message-container">
        @if(session('success'))
          <div id="flash-message" class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
      </div>
    @if (auth()->check() && auth()->user()->isAdmin)
    <a class="create-player-link" href="{{ route('goalies.create') }}">Create goalie</a>

    @else
    @endif
    <form class="search-form" action="{{ route('searchPlayers') }}" method="POST">
        @csrf
        <div class="search-input-container">
            <input type="text" name="search" placeholder="Search for goalie..." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </div>
    </form>


    <div class="player-container">
    <div class="player-grid">
        @if ($goalies->isEmpty())
        <p id="no-player-found">No goalie found.</p>
    @else
                @foreach ($goalies as $goalie)
                   <div class="player-card">
                    <div class="player-info">
                        <img src="{{ asset('players_images/' . $goalie->image_name) }}" alt="{{ $goalie->name }}" class="player-image">
                        <p><a href="{{ route('goalies.showGoalie', ['goalieId' => $goalie->goalie_id]) }}"><span class="player-name">{{ $goalie->name }} {{ $goalie->surname }}</span></a></p>
                        <p>#{{ $goalie->jersey_number }} | {{ $goalie->team->team_name}}</p>
                        @if (auth()->check() && auth()->user()->isAdmin)
                        <a href="{{ route('goalies.edit', $goalie->goalie_id) }}">Edit Goalie</a>
                        <form method="POST" action="{{ route('goalies.destroy', $goalie->goalie_id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button" type="submit" onclick="return confirm('Are you sure you want to delete this goalie?')">Delete</button>
                        </form>
                        @else
                      @endif
                    </div>
                </div>



        @endforeach
        @endif
    </div>
</div>
    </div>
</body>
</html>
@endsection
