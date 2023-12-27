<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Statistics</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto+Mono&family=Varela&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Poppins:wght@500&family=Roboto+Mono&family=Varela&display=swap" rel="stylesheet">
    <script src="{{ asset('js/flash-message.js') }}"></script>
</head>
<body>
    <header>

    <li><div class="logo"> <a href="/"><img src="{{ asset('logo_hockey_80.png') }}" alt="Sports Statistics Logo"></a></div></li>
     @auth
     <li><span class="welcome-message">Welcome, {{auth()->user()->name}}!</span></li>
     <li>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout">
                <img src="{{ asset('logout_30.png') }}" alt="Sports Statistics Logo">
            </button>
        </form>
     </li>

    <li><a href="/users/{{ auth()->user()->id }}/edit"><img class="edit-profile" src="{{ asset('edit_90.png') }}" alt="Sports Statistics Logo"></a></li>

     @else
    <li><div class="login"><a href="/login" ><img src="{{ asset('login_2_80.png') }}" alt="Login"></div>
    </a></li>

    <li><div class="register"><a href="/register" ><img src="{{ asset('sign_up_30.png') }}" alt="Login"></div>
    </a></li>
    @endauth
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                @auth
                <li><a href="/players">Players</a></li>
                <li><a href="/goalies">Goalies</a></li>
                <li><a href="/teams">Teams</a></li>
                <li><a href="/users/{{ auth()->user()->id }}/show">Profile</a></li>
                <li><a href="/games">Games</a></li>
                @if (auth()->user()->isAdmin)
            <!-- Button visible only to admins -->
            <li><a href="/users/all">Users</a></li>
        @endif
                @endauth
            </ul>

        </nav>

    </header>

    <main>
        <div class="container">
            @yield('content') <!-- This is where the page-specific content will be inserted -->
        </div>
    </main>

    <footer>
        <!-- Your website footer content, e.g., copyright information -->
        <p>&copy; {{ date('Y') }} Sports Statistics</p>
    </footer>

    <!-- Add your JavaScript files and other scripts here -->
</body>
</html>
