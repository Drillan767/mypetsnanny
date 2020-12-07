<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:locale" content="fr_FR">
        <link rel="canonical" href="{{ url('/') }}">
        <meta name="description" content="Trouvez votre pet sitter idéal pour une promenade ou une garde de chien à Grenoble ! Optez pour My Pets Nanny !">
        <meta property="og:url" content="{{ url('/') }}/">
        <meta property="og:type" content="website">
        <meta property="og:title" content="My Pet's Nanny | Accueil">
        <meta property="og:site_name" content="My Pet's Nanny">
        <meta name="twitter:card" content="/storage/landing/hero/Rhino-P.jpg">

        <title>{{ config('app.name', 'Laravel') }} | Accueil</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
