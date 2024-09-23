<!DOCTYPE html>
<html lang="pt-BR" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title>Osorno Crypto - Verificação</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 max-w-full font-sans">

    <!-- Main content area -->
    <main class="px-4 py-10 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Realize uma rápida verificação para prosseguir para o site!</h1>

        <!-- CAPTCHA Form -->
        <form action="{{ route('captcha.verify') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            @csrf
            <p class="mb-4">Digite os caracteres que você vê na imagem abaixo:</p>

            <!-- CAPTCHA Image -->
            <div class="mb-4">
                <img src="{{ route('captcha.generate') }}" alt="CAPTCHA Image" class="border border-gray-300 rounded" id="captcha-image">
                <button type="button" class="text-sm text-blue-500 hover:underline mt-2" onclick="reloadCaptcha()">Recarregar</button>
            </div>

            <!-- Input field for CAPTCHA -->
            <input type="text" name="captcha" placeholder="Digite os caracteres" required
                   class="w-full mb-4 p-2 bg-gray-50 border border-gray-300 rounded text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            @if ($errors->has('captcha'))
                <span class="text-red-500">{{ $errors->first('captcha') }}</span>
            @endif

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Verificar
            </button>
        </form>

        @if(session('success'))
            <p class="mt-4 text-green-500">{{ session('success') }}</p>
        @endif
    </main>

    <script>
        // Function to reload the CAPTCHA image
        function reloadCaptcha() {
            document.getElementById('captcha-image').src = '{{ route('captcha.generate') }}?' + new Date().getTime();
        }
    </script>

</body>
</html>
