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
