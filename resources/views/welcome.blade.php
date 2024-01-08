@extends('layout')

@section('content')




<div class="background-image">
    <h1>Sports Statistics Website</h1>
</div>
<div class="flash-message-container">
    @if(session('message'))
      <div id="flash-message" class="alert alert-success">
          {{ session('message') }}
      </div>
    @endif
  </div>
<div class="home-info">
    <h2>Information about the website</h2>
    <p>
        At Sports Statistics, we are dedicated to providing you with comprehensive
        and up-to-date statistics for a wide range of sports. Whether you're a passionate sports fan,
         a fantasy league enthusiast, or someone who simply enjoys staying informed,
        our platform is your go-to destination for in-depth statistical analysis.
    </p>
</div>


<div class="home-info">
<h2>What We Offer</h2>
<ol>
    <li>
        <strong>Player Statistics:</strong>
        Explore detailed statistics for your favorite players. From scoring records to performance metrics, our player statistics cover every aspect of their game. Stay informed about their achievements, milestones, and contributions to their teams.
    </li>
    <li>
        <strong>Player history:</strong>
        Dive into player histories to gain insights into what teams and jersey number they have had in the past.
    </li>
    <li>
        <strong>Game Insights:</strong>
        Access statistics for games and catch up on the statistics of completed matches. Our game insights provide a comprehensive view of player performances and statistical trends.
    </li>
    <li>
        <strong>Goalie Metrics:</strong>
        Goalies play a vital role in many sports, and our platform ensures you have access to their performance metrics. Analyze save percentages, goals against averages, and other key statistics to gauge the effectiveness of goalkeepers.
    </li>
    <li>
        <strong>User Profiles:</strong>
        Create your personalized user profile to tailor your sports statistics experience. Follow your favorite player and team.
    </li>
</ol>
</div>

@endsection('content')
