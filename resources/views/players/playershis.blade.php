@extends('layout')

@section('content')
    <h1>{{ $player->name }} {{ $player->surname }}</h1>
    <img src="{{ asset('players_images/' . $player->image_name) }}" alt="{{ $player->name }}"class="player-image-his">
    @foreach($playerHistory as $history)
    <h2>#{{$history->jersey_number}} | {{$player->position}} | {{$history->team->team_name}}</h2>
    @endforeach



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
