<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

    <!-- Scripts -->
    @stack('scripts')
    @livewireStyles
</head>
<body>
    <div id="app">
        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <!-- JavaScript -->
    <script src="{{ asset('/js/app.js') }}"></script>
    @stack('footer')
</body>
</html>
