<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player History</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>Add Player History</h2>
        <form  method="POST" action="{{ route('history.store') }}">
        @csrf

        <div class="reg-input">
            <input id="player_id" type="hidden" name="player_id" value="{{ $playerId }}">
            @error('player_id')
                <p class="error">{{$message}}</p>
            @enderror
        </div>


        <div class="reg-input">
        <input id="team_id" type="text" name="team_id" placeholder="Team ID" value="{{ old('team_id') }}" class="form-control">
        @error('team_id')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="jersey_number" type="text" name="jersey_number" placeholder="Jersey_number" value="{{ old('jersey_number') }}" class="form-control">
            @error('jersey_number')
            <p class="error">{{$message}}</p>
            @enderror
            </div>

            <div class="reg-input">
                <label for="season_id">Select Season</label>
                <select id="season_id" name="season_id" class="form-control">
                    @foreach($seasons as $season)
                        <option value="{{ $season->season_id }}">{{ $season->season_name }}</option>
                    @endforeach
                </select>
                @error('season_id')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

        <button class="register-btn" type="submit">Add Player</button>
    </form>
    </div>
</div>
  </body>
</html>
