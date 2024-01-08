<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>EDIT</h2>
        <p>Edit your profile, {{{ auth()->user()->name }}}!</p>
    <form method="POST" action="/users/{{$user->id}}">
        @csrf
        @method('PUT')
        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="New Name" value="{{ old('name') }}" class="form-control">
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="username" type="text" name="username" placeholder="New Username" value="{{ old('username') }}" class="form-control">
            @error('username')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

        <div class="reg-input">
        <input id="password" type="password" name="password" placeholder="New Password" class="form-control">
        @error('password')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm New Password" class="form-control">
        @error('password_confirmation')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <button type="submit" class="register-btn">Save changes</button>
    </form>
    </div>
</div>

<footer>
    <p>&copy; {{ date('Y') }} Sports Statistics</p>
</footer>

  </body>
</html>
