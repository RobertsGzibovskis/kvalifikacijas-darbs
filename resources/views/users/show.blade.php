@extends('layout')

@section('content')

<div class="flash-message-container">
    @if(session('message'))
      <div id="flash-message" class="alert alert-success">
          {{ session('message') }}
      </div>
    @endif
  </div>

<div class="user-card">
  <h1 id="user-profile-header">Your profile</h1>

  <p>Name<div class="profile-tag">{{ $user->name }}</div></p>

  <p>Username<div class="profile-tag">{{ $user->username }}</div></p>

  <p>Email<div class="profile-tag">{{ $user->email }}</div></p>

 <div class="favorites">
    @if ($user->favoriteTeam)
      <div class="favorite-item">
        <p>Favourite Team:</p>
        <img class="team-logo" src="{{ asset('team_logos/' . $user->favoriteTeam->logo_filename) }}" alt="Logo">
        <p>{{ $user->favoriteTeam->team_name }}</p>
      </div>
    @else
      <p class="no-favorite">No favorite team selected</p>
    @endif

    @if ($user->favoritePlayer)
      <div class="favorite-item">
        <p>Favourite Player:</p>
        <img src="{{ asset('players_images/' . $user->favoritePlayer->image_name) }}" alt="Player image" class="player-image">
        <p>{{ $user->favoritePlayer->name }} {{ $user->favoritePlayer->surname }}</p>
      </div>
    @else
      <p class="no-favorite">No favorite player selected</p>
    @endif
  </div>
  <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this user?')">Delete Account</button>
</form>
</div>


@endsection
