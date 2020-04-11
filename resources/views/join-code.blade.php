@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-xs-12">
                <div class="m-b-md">
                    <h1>Join a game</h1>
                </div>
                <p style="font-size: 16px;" class="text-center">
                    Anyone who has joined a game that hasn't started should be able to give you the code or send you the link to join.
                </p>
                @if(Session::has('error-message'))
                    <p class="alert alert-danger">{{ Session::get('error-message') }}</p>
                @endif
                <form action="/game/join" method="POST" style="width: 100%;">
                    @csrf
                    <div class="input-group mb-2 mt-2">
                        <input type="text" class="form-control text-center" name="code" placeholder="The game code..">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" type="button">Join</button>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="links">
                    <a href="/">Back to menu</a>
                    <a href="/game/new">New Game</a>
                    <a href="/instructions">Instructions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
