<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>

  <body>

    <div class="reg-parent-container">

    <div class="reg-container">
        <h2>LOGIN</h2>
        <p>Login to your account</p>
    <form method="POST" action="/users/authenticate" novalidate>
        @csrf

        <div class="reg-input">
            <div class="input-container">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control">
            </div>
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

        <button type="submit" class="register-btn">Login</button>
    </form>

    <p>Not a member? <a href="/register">Sign up now!</p>
    </div>
</div>

  </body>
</html>
