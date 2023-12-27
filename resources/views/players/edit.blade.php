<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit player</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>EDIT</h2>
        <p>Edit player {{ $player->name }} {{ $player->surname }}</p>
    <form method="POST" action="/players/{{$player->player_id}}">
        @csrf
        @method('PUT')
        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="New Name" value="{{ old('name') }}" class="form-control">
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="surname" type="text" name="surname" placeholder="New Surname" value="{{ old('username') }}" class="form-control">
            @error('surname')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

        <div class="reg-input">
        <input id="position" type="text" name="position" placeholder="New Position" class="form-control">
        @error('position')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
        <input id="image_name" type="text" name="image_name" placeholder="New Image Name" class="form-control">
        @error('image_name')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <button type="submit" class="register-btn">Save changes</button>
    </form>
    </div>
</div>
