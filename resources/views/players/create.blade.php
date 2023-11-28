<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>Add Player</h2>
        <form  method="POST" action="/players">
        @csrf

        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="form-control">
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="surname" type="text" name="surname" placeholder="Surname" value="{{ old('surname') }}" class="form-control">
            @error('surname')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

        <div class="reg-input">
        <input id="position" type="text" name="position" placeholder="Position" value="{{ old('position') }}" class="form-control">
        @error('position')
            <p class="error">{{$message}}</p>
        @enderror
        </div>


        <div class="reg-input">
        <input id="image_name" type="text" name="image_name" placeholder="Image name" class="form-control">
        @error('image_name')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <button class="register-btn" type="submit">Add Player</button>
    </form>
    </div>
</div>
  </body>
</html>
