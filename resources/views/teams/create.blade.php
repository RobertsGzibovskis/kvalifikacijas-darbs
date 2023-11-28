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
        <h2>Add Team</h2>
        <form  method="POST" action="/teams">
        @csrf

        <div class="reg-input">
        <input id="team_name" type="text" name="team_name" placeholder="Name" value="{{ old('team_name') }}" class="form-control">
        @error('team_name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="logo_filename" type="text" name="logo_filename" placeholder="Logo File Name" value="{{ old('logo_filename') }}" class="form-control">
            @error('logo_filename')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

        <button class="register-btn" type="submit">Add Team</button>
    </form>
    </div>
</div>
  </body>
</html>
