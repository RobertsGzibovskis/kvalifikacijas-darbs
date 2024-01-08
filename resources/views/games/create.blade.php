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

                <!-- Lauki, kuri tiek rādīti, kad ir izvēlēta vērtība 'Scheduled' -->



                        <div class="reg-input">
                            <label for="home_team_id">Home Team</label>
                            <select name="home_team_id" id="home_team_id" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="reg-input">
                            <label for="away_team_id">Away Team</label>
                            <select name="away_team_id" id="away_team_id" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
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


                <div id="finalFields" class="hidden">

                    <div class="reg-input">
                        <label for="winning_team_id">Winning Team</label>
                        <select name="winning_team_id" id="winning_team_id" class="form-control">
                            @foreach($teams as $team)
                                <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                            @endforeach
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
            </div>

                <button type="submit" class="register-btn">Create Game</button>
            </form>
        </div>
    </div>

    <script>
        // Iegūstam atsauce uz izvēlnes elementu ar id "gameStatus"
        var gameStatusDropdown = document.getElementById('gameStatus');
        // Iegūstam atsauces uz laukiem, kas jāparāda, kad spēle ir "Final"
        var scheduledFields = document.getElementById('finalFields');

        gameStatusDropdown.addEventListener('change', function () {
             // Pārbaudam, vai izvēlnes vērtība ir "Final"
          if (gameStatusDropdown.value === 'Final') {
            // Ja ir "Final", noņemam klasi "hidden", lai parādītu laukus
            scheduledFields.classList.remove('hidden');
          } else {
            // Ja nav "Final", pievienojam klasi "hidden", lai paslēptu laukus
            scheduledFields.classList.add('hidden');
          }

          updateFinalFields();
        });
      </script>

</body>

</html>



