<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit game</title>
    <style>
        .hidden {
          display: none;
        }
      </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <div class="reg-parent-container">
        <div class="reg-container">
            <h2>Edit Game</h2>
            <p>{{$game->homeTeam->team_name}} vs {{$game->awayTeam->team_name}}</p>
           <form method="POST" action="/game/{{$game->game_id}}">
            @csrf
            @method('PUT')


            <div class="reg-input">
               <label>Select Game Status</label>
               <select name="game_status" class="form-control" id="gameStatus">
                <option value="Scheduled" {{ old('game_status') == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Final" {{ old('game_status') == 'Final' ? 'selected' : '' }}>Final</option>
            </select>
            </div>



            <div class="reg-input">
                <label for="winning_team_id">Winning Team</label>
                <select name="winning_team_id" id="winning_team_id" class="form-control">
                    <option value="" disabled selected>Select Winning Team</option>
                    <option value="{{ $game->homeTeam->team_id }}">{{ $game->homeTeam->team_name }}</option>
                    <option value="{{ $game->awayTeam->team_id }}">{{ $game->awayTeam->team_name }}</option>

                </select>
            </div>



            <div class="reg-input">

                <input type="text" name="home_team_shots_on_goal" placeholder="Home Team SOG" value="{{ old('home_team_shots_on_goal') }}" class="form-control">
                    @error('home_team_shots_on_goal')
                    <p class="error">{{$message}}</p>
                  @enderror
                </div>

                <div class="reg-input">
                <input type="text" name="away_team_shots_on_goal" placeholder="Away Team SOG" value="{{ old('away_team_shots_on_goal') }}" class="form-control">
                    @error('away_team_shots_on_goal')
                    <p class="error">{{$message}}</p>
                  @enderror
                </div>

            <div class="reg-input">

                <input type="text" name="blocks" placeholder="Blocks" value="{{ old('blocks') }}" class="form-control">
                @error('blocks')
                <p class="error">{{$message}}</p>
              @enderror
            </div>

            <div class="reg-input">

                <input type="text" name="power_play_count" placeholder="Power-Play Count" value="{{ old('power_play_count') }}" class="form-control">
                @error('power_play_count')
                <p class="error">{{$message}}</p>
              @enderror
            </div>



    <button type="submit" class="register-btn">Update Game</button>
</form>

<script>
    var gameStatusDropdown = document.getElementById('gameStatus');
    var scheduledFields = document.getElementById('finalFields');

// Funkcija, kas atjauno redzamos laukus atkarībā no izvēlnes vērtības
    function updateFinalFields() {
         // Pārbaudam, vai izvēlnes vērtība ir "Final"
        if (gameStatusDropdown.value === 'Final') {
            scheduledFields.classList.remove('hidden');
        } else {
            scheduledFields.classList.add('hidden');
        }
    }

    updateFinalFields();

    gameStatusDropdown.addEventListener('change', updateFinalFields);
</script>

</body>

</html>
