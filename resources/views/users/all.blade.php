@extends('layout')

@section('content')
    <h1>All Users</h1>

    <table class="user-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Fav player Id</th>
                <th>Fav team Id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if ($user->favoritePlayer)
                    <td>{{ $user->favorite_player_id }}</td>
                    @else
                  <td>No favorite player selected</td>
                  @endif
                  @if ($user->favoriteTeam)
                    <td>{{ $user->favorite_team_id }}</td>
                  @else
                  <td>No favorite team selected</td>
                  @endif
                    <td>
                        <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
