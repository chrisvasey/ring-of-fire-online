<div>
    <h3>{{ $message }}</h3>
    @if (!$joined)
        <h3>What is your display name?</h3>
        <input type="text" class="form-control text-center" wire:model="playerName">
        <div class="btn btn-primary mt-3" wire:click="join">Join the Game</div>
    @endif

    @if ($joined)
        <h3>Your name:</h3>
        <input type="text" class="form-control text-center" wire:model="playerName">
        <div class="btn btn-primary mt-3" wire:click="changeName">Change Name</div>
    @endif

    @if ($joined && $partyLeader)
        <hr>
        <h3>You are the party leader, click "Start Game" when everyone has joined and you are ready to start</h3>
        <div class="btn btn-danger mt-3" wire:click="startGame">Start Game</div>
    @endif

    @if ($joined && !$partyLeader)
        <hr>
        <h3>You have joined, when everyone has joined the party leader can start the game.</h3>
        <h4>Your party leader is: <strong>{{ $leader->name }}</strong></h4>
    @endif


</div>
