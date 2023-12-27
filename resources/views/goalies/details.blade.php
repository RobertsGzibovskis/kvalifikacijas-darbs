@extends('layout')

@section('content')
<div class="golaie-container">
<div class="goalie-card">
    <h1>{{ $goalie->name }} {{ $goalie->surname }}</h1>
    <img src="{{ asset('players_images/' . $goalie->image_name) }}" alt="{{ $goalie->name }}"class="player-image-his">
    <h2>#{{$goalie->jersey_number}} | {{$goalie->team->team_name}}</h2>


        <div class="statistics">
            <h2>Statistics</h2>
            <ul>
                <li>
                    <span class="stat-label">GAA</span>
                    <span class="stat-value">{{ $goalie->gaa }}</span>
                </li>
                <li>
                    <span class="stat-label">Shutouts</span>
                    <span class="stat-value">{{ $goalie->shutouts }}</span>
                </li>
                <li>
                    <span class="stat-label">Assists</span>
                    <span class="stat-value">{{ $goalie->assists }}</span>
                </li>
            </ul>
        </div>
</div>
</div>

@endsection
