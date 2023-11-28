@extends('layout')

@section('content')


<div class="flash-message-container">
    @if(session('message'))
      <div id="flash-message" class="alert alert-success">
          {{ session('message') }}
      </div>
    @endif
  </div>

@if (auth()->check() && auth()->user()->isAdmin)
<h1>Tu esi baigais admins</h1>
    @else
<h1>Lietas</h1>
@endif

@endsection('content')
