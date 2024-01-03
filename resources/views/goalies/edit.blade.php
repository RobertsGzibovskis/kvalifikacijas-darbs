<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit goalie</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>EDIT</h2>
        <p>Edit Goalie {{ $goalie->name }} {{ $goalie->surname }}</p>
    <form method="POST" action="/goalies/{{$goalie->goalie_id}}">
        @csrf
        @method('PUT')
        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="New Name" value="{{ old('shutouts') }}" class="form-control">
        </div>

        <div class="reg-input">
            <input id="surname" type="text" name="surname" placeholder="Surname" value="{{ old('shutouts')  }}" class="form-control">
            @error('name')
            <p class="error">{{$message}}</p>
            @enderror
            </div>


        <div class="reg-input">
                <label for="team_id">Team</label>
                <select name="team_id" id="team_id" class="form-control">
                    @foreach($teams as $team)
                        <option value="{{ $team->team_id }}" {{ $goalie->team_id == $team->team_id ? 'selected' : '' }}>
                            {{ $team->team_name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="reg-input">
        <input id="gaa" type="text" name="gaa" placeholder="GAA" value="{{ old('shutouts') }}" class="form-control">
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
        <button type="submit" class="register-btn">Save changes</button>
    </form>
    </div>
</div>
