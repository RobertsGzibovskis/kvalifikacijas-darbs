<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create game</title>
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
            <h2>Create a New Game</h2>
            <form  method="POST" action="/game/store" id="createGameForm">
                @csrf

                <div class="reg-input">
                    <input type="text" name="start_time" placeholder="Start Time" value="{{ old('start_time') }}" class="form-control">
                    @error('start_time')
                      <p class="error">{{$message}}</p>
                    @enderror
                </div>

                <div class="reg-input">

                    <input type="date" name="date" placeholder="Date" value="{{ old('date') }}" class="form-control">
                    @error('date')
                      <p class="error">{{$message}}</p>
                    @enderror
                </div>

                <div class="reg-input">
                   <label>Select Game Status</label>
                   <select name="game_status" class="form-control" id="gameStatus">
                    <option value="Scheduled" {{ old('game_status') == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="Final" {{ old('game_status') == 'Final' ? 'selected' : '' }}>Final</option>
                </select>
                </div>

                <!-- Fields to show only when 'Scheduled' is selected -->

                    <div class="reg-input">

                        <input type="text" name="home_team_id" placeholder="Home Team ID" value="{{ old('home_team_id') }}" class="form-control">
                        @error('home_team_id')
                    <p class="error">{{$message}}</p>
                  @enderror
                    </div>

                    <div class="reg-input">

                        <input type="text" name="away_team_id" placeholder="Away Team ID" value="{{ old('away_team_id') }}" class="form-control">
                        @error('away_team_id')
                        <p class="error">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="reg-input">

                        <input type="text" name="season_id" placeholder="Season ID" value="{{ old('season_id') }}" class="form-control">
                        @error('season_id')
                        <p class="error">{{$message}}</p>
                      @enderror
                    </div>


                <div id="finalFields" class="hidden">

                <div class="reg-input">

                    <input type="text" name="winning_team_id" placeholder="Winning Team ID" value="{{ old('winning_team_id') }}" class="form-control">
                    @error('winning_team_id')
                    <p class="error">{{$message}}</p>
                  @enderror
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
            </div>

                <button type="submit" class="register-btn">Create Game</button>
            </form>
        </div>
    </div>

    <script>
        var gameStatusDropdown = document.getElementById('gameStatus');
        var scheduledFields = document.getElementById('finalFields');

        gameStatusDropdown.addEventListener('change', function () {
          if (gameStatusDropdown.value === 'Final') {
            scheduledFields.classList.remove('hidden');
          } else {
            scheduledFields.classList.add('hidden');
          }

          updateFinalFields();
        });


      </script>

</body>

</html>



