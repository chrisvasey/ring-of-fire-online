<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ring Of Fire: Online</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="Ring Of Fire: Online">
    <meta name="description" content="The same brutal drinking game, just online.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Ring Of Fire: Online">
    <meta property="og:description" content="The same brutal drinking game, just online.">
    <meta property="og:image" content="{{ url('/img/ring-of-fire.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Ring Of Fire: Online">
    <meta property="twitter:description" content="The same brutal drinking game, just online.">
    <meta property="twitter:image" content="{{ url('/img/ring-of-fire.png') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/fav/favicon-16x16.png">
    <link rel="manifest" href="/img/fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


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
