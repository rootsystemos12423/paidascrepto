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
    @foreach($tags as $tag)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tag->tag_id }}"></script>
       <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $tag->tag_id }}');
        </script>
    @endforeach
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Event snippet for COMPRA-02 conversion page -->
        @foreach($pixels as $pixel)
        <!-- Meta Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $pixel->pixel_id }}');
            fbq('track', 'PageView');
            // Disparar evento de purchase
            fbq('track', 'Purchase', {
            value: @if(isset(json_decode($payment->checkout->description, true)['plan']))
                        {{ number_format(json_decode($payment->checkout->description, true)['plan']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['maquinas']))
                        {{ number_format(json_decode($payment->checkout->description, true)['maquinas']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['upgradeMaquinas']))
                        {{ number_format(json_decode($payment->checkout->description, true)['upgradeMaquinas']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['salaData']))
                        {{ number_format(json_decode($payment->checkout->description, true)['salaData']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['UpgradePlanData']))
                        {{ number_format(json_decode($payment->checkout->description, true)['UpgradePlanData']['value'], 2, '.', '') }}
                    @endif,
            currency: 'BRL',
            contents: [
                {
                id: '{{ $payment->checkout->id }}',
                quantity: 1
                }
            ],
            content_type: 'product',
            user_data: {
                em: '{{ $email_hash }}'
            }
            });
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $pixel->pixel_id }}&ev=PageView&noscript=1"
            /></noscript>
        <!-- End Meta Pixel Code -->
        @endforeach
</head>
<body class="bg-gray-900 text-gray-100">
@foreach($tags as $tag)    
<script>
    gtag('event', 'conversion', {
        'send_to': '{{ $tag->tag_id }}/{{ $tag->token }}',
        'value':@if(isset(json_decode($payment->checkout->description, true)['plan'])){{ number_format(json_decode($payment->checkout->description, true)['plan']['value'], 2, '.', '') }}@elseif(isset(json_decode($payment->checkout->description, true)['maquinas'])){{ number_format(json_decode($payment->checkout->description, true)['maquinas']['value'], 2, '.', '') }}@elseif(isset(json_decode($payment->checkout->description, true)['upgradeMaquinas'])){{ number_format(json_decode($payment->checkout->description, true)['upgradeMaquinas']['value'], 2, '.', '') }}@elseif(isset(json_decode($payment->checkout->description, true)['salaData'])){{ number_format(json_decode($payment->checkout->description, true)['salaData']['value'], 2, '.', '') }}@elseif(isset(json_decode($payment->checkout->description, true)['UpgradePlanData'])){{ number_format(json_decode($payment->checkout->description, true)['UpgradePlanData']['value'], 2, '.', '') }}@endif,
        'currency': 'BRL',
        'transaction_id': '{{ $payment->order_id }}'
    });
</script>
@endforeach
    <div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-gray-800 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="p-6 w-full text-center">
            <i class="text-7xl fa-regular fa-circle-check mx-auto mb-4 w-20 h-20 text-emerald-400"></i>
            <h2 class="text-2xl leading-8 font-semibold text-white">Agradecemos pelo seu pagamento!</h2>
            <p class="mt-4 text-gray-300">Seu pagamento foi processado com sucesso.</p>
            <p class="mt-2 text-gray-300">Você receberá em breve um e-mail com os detalhes da sua compra e informações adicionais.</p>

            <!-- Início da seção de detalhes da compra -->
            <div class="mt-6 px-6 py-4 bg-gray-700 rounded-lg">
                <h3 class="text-xl text-white font-semibold">Detalhes da Compra</h3>
                <div class="mt-4 text-left">
                    <div id="valorTotal">
                    <p class="text-gray-300"><strong>Valor:
                    @if(isset(json_decode($payment->checkout->description, true)['plan']))
                        R${{ number_format(json_decode($payment->checkout->description, true)['plan']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['maquinas']))
                        R${{ number_format(json_decode($payment->checkout->description, true)['maquinas']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['upgradeMaquinas']))
                        R${{ number_format(json_decode($payment->checkout->description, true)['upgradeMaquinas']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['salaData']))
                        R${{ number_format(json_decode($payment->checkout->description, true)['salaData']['value'], 2, '.', '') }}
                    @elseif(isset(json_decode($payment->checkout->description, true)['UpgradePlanData']))
                        R${{ number_format(json_decode($payment->checkout->description, true)['UpgradePlanData']['value'], 2, '.', '') }}
                    @endif
                </strong></p>
                    </div>
                    <div id="email">
                    <p class="text-gray-300"><strong>E-mail:</strong> {{ $payment->checkout->email }}</p>
                    </div>
                    <!-- Adicione mais detalhes conforme necessário -->
                </div>
            </div>
            <!-- Fim da seção de detalhes da compra -->

            <div class="mt-6">
                <a href="/" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voltar para o Início</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
