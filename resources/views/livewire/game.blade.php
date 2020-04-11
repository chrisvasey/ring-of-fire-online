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
            <hr>
            <p>You can find the rules for each card <a href="/instructions" target="_blank">here</a>, otherwise they will be displayed when each card is pulled.</p>
        </div>
        @if ($state != 'ended')
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    @if ($currentPlayer->id == $playerId)
                        @if ($state == 'ready-to-draw')
                            <h1 class="text-center">It's your turn, good luck!</h1>
                            <div class="text-center">
                                <button class="btn btn-danger btn-lg mt-2" wire:click="drawCard">Draw Card</button>
                            </div>
                        @endif
                        @if ($state == 'drawn-waiting' && $drawnCard)
                            <h1 class="text-center">You pulled the {{ $drawnCard->prettyValue() }}</h1>
                            <p class="text-center">{{ $drawnCard->instructions() }}</p>
                        @endif
                        @if ($state == 'drawn-waiting' && $currentPlayer->id == $playerId && $drawnCard)
                            <div class="text-center">
                                <button class="btn btn-success btn-lg mt-2" wire:click="nextTurn">Done, end turn</button>
                            </div>
                        @endif
                    @else
                        <h1 class="text-center">Current Players Turn: <span class="player-text {{ $currentPlayer->color }}">{{ $currentPlayer->name }}</span> 🍺🍻</h1>
                        @if ($state == 'ready-to-draw')
                            <h3 class="text-center">Waiting for them to pull a card..</h3>
                        @endif
                        @if ($state == 'drawn-waiting' && $drawnCard)
                            <h3 class="text-center">{{ $currentPlayer->name }} pulled the <span style="font-weight: 600">{{ $drawnCard->prettyValue() }}</span></h3>
                            <p class="text-center">{{ $drawnCard->instructions() }}</p>
                        @endif
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-stage mt-4">
                        <div class="card-wrap">
                            @if ($state == 'ready-to-draw')
                                <img class="card-placeholder img-fluid" src="/img/back-of-card.jpg">
                            @endif
                            @if ($drawnCard && $state == 'drawn-waiting')
                                <img class="card-placeholder img-fluid" src="/img/cards/{{ strtoupper($drawnCard->value) }}.svg">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mt-4">
                        <h1>That's all the cards done!</h1>
                        <h3>Hope you are all okay.</h3>
                        <a href="/game/new" class="btn btn-success">Start new game</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
