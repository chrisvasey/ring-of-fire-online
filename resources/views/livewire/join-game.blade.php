<div>
    <h3>{{ $message }}</h3>
    <h3>What is your display name?</h3>
    <input type="text" class="form-control text-center" wire:model="playerName">
    @if (!$joined)
        <div class="btn btn-primary mt-3" wire:click="join">Join the Game</div>
    @endif
    @if ($joined)
        <div class="btn btn-primary mt-3" wire:click="changeName">Change Name</div>
    @endif


</div>
