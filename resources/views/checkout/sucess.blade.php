<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    $email = $payment->checkout->email;
    $email_hash = hash('sha256', strtolower(trim($email)));
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento pelo Pagamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16701155888">
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10798544488">
    </script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'AW-10798544488');
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-16701155888');
    </script>
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-16701155888/5MBoCIq9t9IZELDU3Zs-',
            'value': {{ number_format((float) str_replace('.', '', str_replace('.', '', preg_replace("/[^0-9,]/", "", $description['valor']))), 2, '.', '') }},
            'currency': 'BRL',
            'transaction_id': '{{ $payment->order_id }}'
        });
      </script>
       <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-10798544488/nvLKCNKD_dIZEOjskp0o',
            'value': {{ number_format((float) str_replace('.', '', str_replace('.', '', preg_replace("/[^0-9,]/", "", $description['valor']))), 2, '.', '') }},
            'currency': 'BRL',
            'transaction_id': '{{ $payment->order_id }}'
        });
      </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Event snippet for COMPRA-02 conversion page -->
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-6 w-full text-center">
                <i class="text-7xl fa-regular fa-circle-check mx-auto mb-4 w-20 h-20 text-blue-900"></i>
                <h2 class="text-2xl leading-8 font-semibold text-gray-900">Agradecemos pelo seu pagamento!</h2>
                <p class="mt-4 text-gray-700">Seu pagamento foi processado com sucesso.</p>
                <p class="mt-2 text-gray-700">Você receberá em breve um e-mail com os detalhes da sua compra e informações adicionais.</p>

                <!-- Início da seção de detalhes da compra -->
                <div class="mt-6 px-6 py-4 bg-gray-100 rounded-lg">
                    <h3 class="text-xl text-gray-900 font-semibold">Detalhes da Compra</h3>
                    <div class="mt-4 text-left">
                        <div id="valorTotal">
                            <p class="text-gray-700"><strong>Valor:</strong> {{ $description['valor'] }}</p>
                        </div>
                        <div id="email">
                            <p class="text-gray-700"><strong>E-mail:</strong> {{ $payment->checkout->email }}</p>
                        </div>
                        <!-- Adicione mais detalhes conforme necessário -->
                    </div>
                </div>
                <!-- Fim da seção de detalhes da compra -->

                <div class="mt-6">
                    <a href="/" class="inline-block bg-blue-900 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voltar para o Início</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
