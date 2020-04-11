@extends('layouts.app')

@section('content')
    @livewire('game', ['game' => $game, 'player' => $player])
@endsection
