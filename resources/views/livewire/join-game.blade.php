<div class="row">
    <div class="col-md-12 col-xs-12 text-center">
        <h3>{{ $message }}</h3>
    </div>

    <div class="col-md-6 col-xs-12 text-center">
        @if (!$joined)
            <div class="col-md-6 offset-md-3 col-xs-12">
                <h3 class="text-center">What is your display name?</h3>
                <input type="text" class="form-control text-center" wire:model="playerName">
                <button type="button" class="btn btn-primary mt-3" wire:click="join">Join the Game</button>
            </div>
        @endif

        @if ($joined)
            <div class="col-md-8 offset-md-2 col-xs-12">
                <h3>Your name:</h3>
                <input type="text" class="form-control text-center" wire:model="playerName">
                <button type="button" class="btn btn-primary mt-3" wire:click="changeName">Change Name</button>
            </div>
        @endif

        @if ($joined && $partyLeader)
            <div class="col-md-8 offset-md-2 col-xs-12">
                <hr>
                <h3>You are the party leader, click "Start Game" when everyone has joined and you are ready to start</h3>
                <button type="button" class="btn btn-danger mt-3" wire:click="startGame">Start Game</button>
            </div>
        @endif

        @if ($joined && !$partyLeader)
            <div class="col-md-8 offset-md-2 col-xs-12">
                <hr>
                <h3>You have joined, when everyone has joined the party leader can start the game.</h3>
                <h4>Your party leader is: <strong>{{ $leader->name }}</strong></h4>
            </div>
        @endif
    </div>

    <div class="col-md-6 col-xs-12  ">
        <h3>Joined Players</h3>
        <div class="row">
            @foreach ($players as $player)
                <div class="col-md-3 col-xs-6">
                    <div class="mt-2 mb-4">
                        <div class="avatar {{ $player['color'] }}">
                            <h3>{{ strtoupper(mb_substr($player['name'], 0, 1, "UTF-8")) }}</h3>
                        </div>
                        <h4 class="text-center mt-2">{{ $player['name'] }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</div>
