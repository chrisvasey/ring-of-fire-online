<div class="container-fluid" wire:poll.750ms="refeshGame">
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
                <h4><span class="player-text {{ $player->color }}">{{ $player->name }}@if($player->id == $playerId) (you)@endif</span> @if($player->turnCheck()) - This players turn @endif</h4>
            @endforeach
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Current Players Turn: <span class="player-text {{ $currentPlayer->color }}">{{ $currentPlayer->name }}</span> 🍺🍻</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-stage mt-4">
                        <div class="card-wrap">
                            @if ($state == 'ready-to-draw')
                                <img wire:click="drawCard" class="card-placeholder img-fluid" src="/img/back-of-card.jpg">
                            @endif
                            @if ($drawnCard && $state == 'drawn-waiting')
                                <img class="card-placeholder img-fluid" src="/img/cards/{{ strtoupper($drawnCard->value) }}.svg">
                            @endif
                        </div>
                        <h3 class="text-center mt-4">{{ $cardMessage }}</h3>
                        @if ($state == 'drawn-waiting' && $currentPlayer->id == $playerId)
                            <button class="btn btn-success btn-block" wire:click="nextTurn">End your turn</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
