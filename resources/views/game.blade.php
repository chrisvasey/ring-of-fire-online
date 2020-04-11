@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <h2>This is a game!</h2>
            <h3>You are: {{ $player->name }}</h3>


            {{-- @livewire('join-game', ['game' => $game]) --}}
        </div>
</div>

@endsection
