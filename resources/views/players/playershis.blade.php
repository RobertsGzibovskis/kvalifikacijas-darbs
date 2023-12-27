@extends('layout')

@section('content')
    <h1>{{ $player->name }} {{ $player->surname }}</h1>
    <img src="{{ asset('players_images/' . $player->image_name) }}" alt="{{ $player->name }}"class="player-image-his">
    @foreach($playerHistory as $history)
    @if($history->season_id == 10)
        <h2>#{{$history->jersey_number}} | {{$player->position}} | <img class="player-team-logo-his" src="{{ asset('team_logos/' . $history->team->logo_filename) }}" alt="Team Logo"></h2>
    @endif
@endforeach
@if (auth()->check() && auth()->user()->isAdmin)
    <a class="create-player-link" href="{{ route('history.create', ['playerId' => $player->player_id]) }}">Add Player History</a>
@else
@endif


    <table class="player-history-table">
        <thead>
            <tr>
                <th>Season</th>
                <th>Jersey Number</th>
                <th>Team</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playerHistory as $history)
                <tr>
                    <td>{{$history->season->season_name}}</td>
                    <td>{{$history->jersey_number }}</td>
                    <td>{{$history->team->team_name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
