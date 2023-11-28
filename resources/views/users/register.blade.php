<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>CREATE ACCOUNT</h2>
    <form method="POST" action="/users" novalidate>
        @csrf

        <div class="reg-input">
        <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="form-control">
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
            <input id="username" type="text" name="username" placeholder="Username" value="{{ old('username') }}" class="form-control">
            @error('username')
                <p class="error">{{$message}}</p>
            @enderror
            </div>

        <div class="reg-input">
        <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control">
        @error('email')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
        <input id="password" type="password" name="password" placeholder="Password" class="form-control">
        @error('password')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <div class="reg-input">
        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
        @error('password_confirmation')
            <p class="error">{{$message}}</p>
        @enderror
        </div>

        <button type="submit" class="register-btn">Register</button>
    </form>
    </div>
</div>
  </body>
</html>
