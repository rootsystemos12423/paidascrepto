<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/1219283420207906882/1219283603884871700/logo-no-bg.png?ex=660abd58&is=65f84858&hm=3a6017d376e3dc90b48e9c9bf4315c83d42a5fc1a61b76e744009483733fcab6&" type="image/x-icon">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script
        src='//fw-cdn.com/12022705/4556207.js'
        chat='true'>
        </script>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16701155888">
        </script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-16701155888');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10798544488">
        </script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'AW-10798544488');
        </script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
                <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WL4RN8XZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
