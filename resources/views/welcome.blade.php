@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Ring of Fire: Online 🍺
        </div>

        @if(Session::has('error-message'))
            <p class="alert alert-danger">{{ Session::get('error-message') }}</p>
        @endif

        <div class="links">
            <a href="/game/new">New Game</a>
            <a href="/join">Join Game</a>
            <a href="/rules">Game Rules</a>
        </div>
    </div>
</div>
@endsection
