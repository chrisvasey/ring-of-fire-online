@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <h2>Welcome!</h2>
            You are waiting for the game to start, to invite people sent them this link: <br>

            <div class="input-group mb-2 mt-2">
              <input type="text" class="form-control" id="copy-code" value="{{ url('/game'.$game->code) }}">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="clipboard-copy" data-clipboard-target="#copy-code">Copy</button>
              </div>
            </div>
            If they are joining from the main menu the game code is: <strong>{{ $game->code  }}</strong>
            <hr>
            @livewire('join-game')
        </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.addEventListener('load', (event) => {
          new ClipboardJS('#clipboard-copy');
        });
    </script>
@endpush

@endsection
