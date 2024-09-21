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
    <script>
        !function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.install=t():e.install=t()}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";var o=this&&this.__spreadArray||function(e,t,n){if(n||2===arguments.length)for(var o,r=0,i=t.length;r<i;r++)!o&&r in t||(o||(o=Array.prototype.slice.call(t,0,r)),o[r]=t[r]);return e.concat(o||Array.prototype.slice.call(t))};Object.defineProperty(t,"__esModule",{value:!0});var r=function(e,t,n){var o,i=e.createElement("script");i.type="text/javascript",i.async=!0,i.src=t,n&&(i.onerror=function(){r(e,n)});var a=e.getElementsByTagName("script")[0];null===(o=a.parentNode)||void 0===o||o.insertBefore(i,a)};!function(e,t,n){e.KwaiAnalyticsObject=n;var i=e[n]=e[n]||[];i.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];var a=function(e,t){e[t]=function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];var i=o([t],n,!0);e.push(i)}};i.methods.forEach((function(e){a(i,e)})),i.instance=function(e){var t,n=(null===(t=i._i)||void 0===t?void 0:t[e])||[];return i.methods.forEach((function(e){a(n,e)})),n},i.load=function(e,o){var a="https://s1.kwai.net/kos/s101/nlav11187/pixel/events.js";i._i=i._i||{},i._i[e]=[],i._i[e]._u=a,i._t=i._t||{},i._t[e]=+new Date,i._o=i._o||{},i._o[e]=o||{};var c="?sdkid=".concat(e,"&lib=").concat(n);r(t,a+c,"https://s16-11187.ap4r.com/kos/s101/nlav11187/pixel/events.js"+c)}}(window,document,"kwaiq")}])}));
    </script>
    <script>
        kwaiq.load('258922210021613');
        kwaiq.page();
        kwaiq.track('purchase')
    </script>
       
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '822625240026690'); // Substitua YOUR_PIXEL_ID pelo seu ID do Pixel
        fbq('track', 'Purchase', {
            value: {{ number_format((float) str_replace('.', '', str_replace('.', '', preg_replace("/[^0-9,]/", "", $description['valor']))), 2, '.', '') }},
            currency: 'BRL'
        });
    </script>
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=822625240026690&ev=PageView&noscript=1"
    /></noscript>
    @foreach ($tags as $tag)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tag->tag_id }}">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', '{{ $tag->tag_id }}');
      </script>
    <script>
          gtag('event', 'conversion', {
              'send_to': '{{ $tag->tag_id }}/{{ $tag->token }}',
              'value': {{ number_format((float) str_replace('.', '', str_replace('.', '', preg_replace("/[^0-9,]/", "", $description['valor']))), 2, '.', '') }},
              'currency': 'BRL',
              'transaction_id': '{{ $payment->order_id }}'
          });
    </script>
    @endforeach
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
