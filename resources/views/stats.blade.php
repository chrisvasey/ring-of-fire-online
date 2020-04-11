@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content container">
        <div class="m-b-md text-center">
            <h1>Stats 🍺</h1>
            <h3>All stats since 11th or April</h3>
            <h3>Total games started: {{ $gamesCount }}</h3>
            <h3>Total players who have pulled a card: {{ $playerCount }}</h3>
            <h3>Number of cards pulled: {{ $cardsPulled }}</h3>
        </div>


        <div class="links">
            <a href="/">Back to menu</a>
        </div>
    </div>
</div>
@endsection
