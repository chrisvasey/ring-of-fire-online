<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <h3 class="text-center">
                Cards Remaining:
            </h3>
            <h2 class="text-center">{{ $cardsRemaining }}</h2>
            <hr>
            <h3>
                Players
            </h3>
            @foreach ($players as $player)
                <h4 class="player-text {{ $player->color }}">{{ $player->name }}</h4>
            @endforeach
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Current Players Turn: <span class="player-text orange">{{ $playerName }}</span> 🍺🍻</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-stage mt-4">
                        <div class="card-wrap">
                            <img class="card-placeholder img-fluid" src="/img/back-of-card.jpg">
                        </div>
                        <h3 class="text-center mt-4">{{ $cardMessage }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
