<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
        <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
        <script
        src='//fw-cdn.com/12022705/4556207.js'
        chat='true'>
        </script>
           <script>
            !function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.install=t():e.install=t()}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";var o=this&&this.__spreadArray||function(e,t,n){if(n||2===arguments.length)for(var o,r=0,i=t.length;r<i;r++)!o&&r in t||(o||(o=Array.prototype.slice.call(t,0,r)),o[r]=t[r]);return e.concat(o||Array.prototype.slice.call(t))};Object.defineProperty(t,"__esModule",{value:!0});var r=function(e,t,n){var o,i=e.createElement("script");i.type="text/javascript",i.async=!0,i.src=t,n&&(i.onerror=function(){r(e,n)});var a=e.getElementsByTagName("script")[0];null===(o=a.parentNode)||void 0===o||o.insertBefore(i,a)};!function(e,t,n){e.KwaiAnalyticsObject=n;var i=e[n]=e[n]||[];i.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];var a=function(e,t){e[t]=function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];var i=o([t],n,!0);e.push(i)}};i.methods.forEach((function(e){a(i,e)})),i.instance=function(e){var t,n=(null===(t=i._i)||void 0===t?void 0:t[e])||[];return i.methods.forEach((function(e){a(n,e)})),n},i.load=function(e,o){var a="https://s1.kwai.net/kos/s101/nlav11187/pixel/events.js";i._i=i._i||{},i._i[e]=[],i._i[e]._u=a,i._t=i._t||{},i._t[e]=+new Date,i._o=i._o||{},i._o[e]=o||{};var c="?sdkid=".concat(e,"&lib=").concat(n);r(t,a+c,"https://s16-11187.ap4r.com/kos/s101/nlav11187/pixel/events.js"+c)}}(window,document,"kwaiq")}])}));
            </script>
            <script>
                kwaiq.load('258946222804614');
                kwaiq.page();
                kwaiq.track('contentView');
            </script>
           @foreach ($tags as $tag)
           <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tag->tag_id }}">
           </script>
           <script>
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());
             
               gtag('config', '{{ $tag->tag_id }}');
             </script>
           @endforeach
        <title>Osorno Crypto - O melhor site de mineração do Brasil</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles

        @if(request()->routeIs('saques.efetuar'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @endif

    </head>
    <body class="font-roboto antialiased bg-gray-100">
        
        <x-banner />

        <x-alert-message />

        <div class="flex lg:gap-x-64 flex-col md:flex-row">
            <!-- Sidebar -->
            <x-sidebar class="w-1/4 bg-white shadow-lg h-screen relative" />

            <!-- Conteúdo Principal -->
            <div class="flex-1 md:p-12 max-w-full h-screen">
               <!-- Header -->
<header class="mb-6 bg-white p-4 rounded-lg flex flex-col md:flex-row items-center justify-between">
    <!-- Título da Dashboard -->
    <h1 class="text-md font-medium text-gray-500 mb-4 md:mb-0">Dashboard</h1>

    <!-- Ticker de Criptomoedas (Visível apenas em telas grandes) -->
    <div class="w-full lg:w-auto lg:flex hidden justify-center lg:justify-start overflow-x-auto">
        <div class="flex items-center space-x-8">
            @if (isset($cryptoPrices) && $cryptoPrices->isNotEmpty())
            @foreach ($cryptoPrices as $crypto)
            <div class="flex items-center text-xs font-medium">
                <!-- Logo da Cripto -->
                <img src="/images/cripto-logos/{{ strtoupper($crypto->crypto_symbol) }}.png" alt="{{ $crypto->crypto_symbol }}" class="h-6 w-6 mr-2">
                <!-- Valorização/Desvalorização -->
                @if ($crypto->change_pct_24h !== null)
                @if ($crypto->change_pct_24h > 0)
                <span class="text-green-500 font-semibold">R$ {{ number_format($crypto->price_in_brl, 2, ',', '.') }}</span>
                <span class="text-green-500 ml-2">
                    <i class="fas fa-arrow-up"></i> +{{ number_format($crypto->change_pct_24h, 2) }}%
                </span>
                @else
                <span class="text-red-500 font-semibold">R$ {{ number_format($crypto->price_in_brl, 2, ',', '.') }}</span>
                <span class="text-red-500 ml-2">
                    <i class="fas fa-arrow-down"></i> {{ number_format($crypto->change_pct_24h, 2) }}%
                </span>
                @endif
                @endif
            </div>
            @endforeach
            @else
            <!-- Caso não haja criptomoedas disponíveis -->
            <div class="text-gray-500">Preços de criptomoedas indisponíveis</div>
            @endif
        </div>
    </div>

    <!-- Informações do Usuário (Visível em telas médias e maiores) -->
    <div class="md:flex items-center gap-4 hidden">
        <!-- Informações do Usuário -->
        <div class="flex flex-col items-center md:items-end text-center md:text-right">
            <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
            <span class="text-xs">Usuário</span>
        </div>

        <!-- Foto do Perfil do Usuário -->
        <div>
            <img src="{{ auth()->user()->profile_photo_url }}" alt="Foto do Perfil" class="h-12 w-12 rounded-full">
        </div>
    </div>

    <!-- Informações do Usuário para dispositivos móveis -->
    <div class="flex hidden lg:hidden items-center gap-2 mt-4">
        <img src="{{ auth()->user()->profile_photo_url }}" alt="Foto do Perfil" class="h-10 w-10 rounded-full">
        <div class="flex flex-col text-center md:text-right">
            <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
            <span class="text-xs">Usuário</span>
        </div>
    </div>
</header>

                                      

                <!-- Slot de Conteúdo -->   
                <div class="rounded-lg p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>


        @stack('modals')

        @livewireScripts        
    </body>
</html>
