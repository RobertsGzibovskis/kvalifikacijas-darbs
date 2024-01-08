@extends('layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Teams</title>
</head>
<body>
    <div class="team-background">
        <h1>Teams</h1>

        <div class="flash-message-container">
            @if(session('success'))
              <div id="flash-message" class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
          </div>

        @if (auth()->check() && auth()->user()->isAdmin)
    <a class="create-player-link" href="/teams/create">Create team</a>
    @else
    @endif
    <div class="team-container">
        <div class="team-grid">
            @foreach($teams as $team)
                <div class="team">
                    <img class="team-logo" src="{{ asset('team_logos/' . $team->logo_filename) }}" alt="{{ $team->team_name }} Logo">
                    <div class="team-name">{{ $team->team_name }}</div>
                    @auth
                    <form method="POST" action="{{ route('users.addFavoriteTeam', ['team' => $team->team_id]) }}">
                        @csrf
                        <button type="submit" class="favorite-button">Set as Favorite Team</button>
                    </form>
                    @if (auth()->check() && auth()->user()->isAdmin)
                    <form method="POST" action="{{ route('teams.destroy', $team->team_id) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button  class="delete-button" type="submit" onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
                    </form>
                    @else
                  @endif
                @endauth
                </div>
            @endforeach
        </div>
    </div>
    {{ $teams->links() }}
</div>

</body>
</html>
@endsection
