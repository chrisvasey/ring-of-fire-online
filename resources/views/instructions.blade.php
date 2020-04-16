@extends('layouts.app')

@section('content')
<div class="flex-center position-ref">
    <div class="content container">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-xs-12">
                <h1>So you want to know how to play ring of fire..</h1>
                <p style="font-size: 16px;">
                    From a deck of cards players take it in turns to draw cards until the deck is finished. <br>
                    Each card results in a different action the player must do (most are drining). <br>
                    The following rules are adapted to make it easier to play online.
                </p>
                <hr>
                <ul class="text-left">
                    @foreach (['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'] as $value)
                        @php
                            $card = new App\Card;
                            $card->number = $value
                        @endphp
                        <li>{{ $card->instructions() }}</li>
                    @endforeach
                </ul>
                <hr>

                <div class="links">
                    <a href="/">Back to menu</a>
                    <a href="/game/new">New Game</a>
                    <a href="/join">Join Game</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
