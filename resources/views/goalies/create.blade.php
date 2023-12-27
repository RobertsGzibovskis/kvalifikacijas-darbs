<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Goalie</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>Add Goalie</h2>
        <form method="POST" action="{{ route('goalies.store') }}">
        @csrf

        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="form-control">
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="surname" type="text" name="surname" placeholder="Surname" value="{{ old('surname') }}" class="form-control">
            @error('name')
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
        <input id="gaa" type="text" name="gaa" placeholder="GAA" value="{{ old('gaa') }}" class="form-control">
        @error('gaa')
            <p class="error">{{$message}}</p>
        @enderror
        </div>


        <div class="reg-input">
        <input id="shutouts" type="text" name="shutouts" placeholder="Shutouts" value="{{ old('shutouts') }}" class="form-control">
        @error('shutouts')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="jersey_number" type="text" name="jersey_number" placeholder="Jersey Number" value="{{ old('jersey_number') }}" class="form-control">
            @error('jersey_number')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

            <div class="reg-input">
                <input id="assists" type="text" name="assists" placeholder="Assists" value="{{ old('assists') }}" class="form-control">
                @error('assists')
                    <p class="error">{{$message}}</p>
                @enderror
                </div>

                <div class="reg-input">
                    <input id="image_name" type="text" name="image_name" placeholder="Image Name" value="{{ old('image_name') }}" class="form-control">
                    @error('image_name')
                        <p class="error">{{$message}}</p>
                    @enderror
                    </div>

        <button class="register-btn" type="submit">Add Goalie</button>
    </form>
    </div>
</div>
  </body>
</html>
