@extends('layouts.app')

@section('content')
<div class="flex-center position-ref">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-xs-12 text-center">
                <h2>Welcome to Ring of Fire! 🍺</h2>
                We are waiting for the game to start, to invite people sent them this link: <br>

                @if(Session::has('error-message'))
                <p class="alert alert-info">{{ Session::get('error-message') }}</p>
                @endif

                <div class="input-group mb-2 mt-2">
                  <input type="text" class="form-control text-center" id="copy-code" value="{{ url('/game/'.$game->code) }}">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="clipboard-copy" data-clipboard-target="#copy-code">Copy</button>
                  </div>
                </div>
                If they are joining from the main menu the game code is: <strong>{{ $game->code  }}</strong>
                <br>
                If you want something to do while you wait, you can read the game rules <a href="/rules" target="_blank">here</a>.
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        @livewire('join-game', ['game' => $game])

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
