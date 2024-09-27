<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
    $email = $payment->checkout->email;
    $email_hash = hash('sha256', strtolower(trim($email)));
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
    <link rel="shortcut icon" href="/images/logo.webp" type="image/x-icon">
    <title>Osorno Crypto - PIX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        !function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.install=t():e.install=t()}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";var o=this&&this.__spreadArray||function(e,t,n){if(n||2===arguments.length)for(var o,r=0,i=t.length;r<i;r++)!o&&r in t||(o||(o=Array.prototype.slice.call(t,0,r)),o[r]=t[r]);return e.concat(o||Array.prototype.slice.call(t))};Object.defineProperty(t,"__esModule",{value:!0});var r=function(e,t,n){var o,i=e.createElement("script");i.type="text/javascript",i.async=!0,i.src=t,n&&(i.onerror=function(){r(e,n)});var a=e.getElementsByTagName("script")[0];null===(o=a.parentNode)||void 0===o||o.insertBefore(i,a)};!function(e,t,n){e.KwaiAnalyticsObject=n;var i=e[n]=e[n]||[];i.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];var a=function(e,t){e[t]=function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];var i=o([t],n,!0);e.push(i)}};i.methods.forEach((function(e){a(i,e)})),i.instance=function(e){var t,n=(null===(t=i._i)||void 0===t?void 0:t[e])||[];return i.methods.forEach((function(e){a(n,e)})),n},i.load=function(e,o){var a="https://s1.kwai.net/kos/s101/nlav11187/pixel/events.js";i._i=i._i||{},i._i[e]=[],i._i[e]._u=a,i._t=i._t||{},i._t[e]=+new Date,i._o=i._o||{},i._o[e]=o||{};var c="?sdkid=".concat(e,"&lib=").concat(n);r(t,a+c,"https://s16-11187.ap4r.com/kos/s101/nlav11187/pixel/events.js"+c)}}(window,document,"kwaiq")}])}));
        </script>
        <script>
            kwaiq.load('258946222804614');
            kwaiq.page();
            kwaiq.track('initiatedCheckout');
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
</head>

<body class="bg-gray-300 text-gray-100 font-roboto antialiased">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-gray-100 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-6">
                <div class="text-center">
                    <div class="uppercase tracking-wide text-xs text-blue-950 font-semibold mb-2">Pedido: {{ $payment->order_id }}</div>
                    <p class="text-3xl font-bold text-gray-800 leading-tight mb-4">Total: {{ $description['valor'] }}</p>
                    <p class="text-sm text-gray-500">Copie o código abaixo e cole no seu banco na função PIX Copia e Cola:</p>
                    <div class="mt-4 bg-gray-200 p-4 rounded-lg font-mono text-sm break-words text-gray-800 font-semibold">
                        <span id="pixCode">{{ $payment->pix_code_url }}</span>
                    </div>
                    <button id="copyButton" class="mt-4 bg-blue-950 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <i class="fa-solid fa-copy text-white mr-3"></i>
                        <span>Copiar código (PIX Copia e Cola)</span>
                    </button>
                </div>
    
                <div class="mt-6 text-center text-gray-600">Também pode ler o nosso QRCode:</div>
                <div class="mt-4 flex justify-center">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                        <div id="qrcode"></div>
                    </div>
                </div>
    
                <div class="mt-6 text-left text-gray-500">
                    <p class="mb-2">Instruções para pagamento:</p>
                    <ol class="list-decimal list-inside">
                        <li>Abra o aplicativo do seu banco no celular</li>
                        <li>Selecione a opção de pagar com Pix / escanear QR code</li>
                        <li>Após o pagamento, você receberá por email os dados de acesso à sua compra</li>
                    </ol>
                </div>
    
                <div class="mt-6 bg-blue-950 p-3 rounded-lg text-white font-semibold text-center">
                    A compra será confirmada automaticamente após o pagamento.
                </div>
            </div>
        </div>
        <div class="flex w-full p-4 justify-center items-center gap-4 mt-4">
            <img src="/images/logo.webp" class="w-14">
            <span class="text-2xl text-gray-800 font-semibold">Osorno Crypto</span>
        </div>
    </div>
    

    <script>
    document.getElementById('copyButton').addEventListener('click', function() {
        const pixCode = document.getElementById('pixCode').innerText;

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(pixCode).then(() => {
                alert('Código PIX copiado!');
            }).catch(err => {
                console.error('Erro ao copiar o texto: ', err);
                alert('Erro ao copiar o código PIX.');
            });
        } else {
            // Fallback para browsers que não suportam clipboard.writeText
            // Utilizando execCommand para copiar conteúdo para o clipboard
            const textarea = document.createElement('textarea');
            textarea.value = pixCode;
            document.body.appendChild(textarea);
            textarea.select();

            try {
                const successful = document.execCommand('copy');
                const msg = successful ? 'Código PIX copiado!' : 'Erro ao copiar o código PIX.';
                alert(msg);
            } catch (err) {
                console.error('Erro ao copiar o texto com execCommand: ', err);
                alert('Erro ao copiar o código PIX.');
            }

            document.body.removeChild(textarea);
        }
    });
</script>


<script>
  var QR_CODE = new QRCode("qrcode", {
    width: 220,
    height: 220,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.L, // Use um nível de correção de erros menor
});

  QR_CODE.makeCode("{{ $payment->pix_code_url }}")
</script>


<script>
        document.addEventListener('DOMContentLoaded', () => {
         window.Echo.channel('payment')
        .listen('.sucess', (data) => {
            console.log('Event received:', data);
            const currentPageId = window.location.pathname.split('/').pop(); // Captura o ID da URL
            if(data.checkoutId == currentPageId) {
                // O ID do evento corresponde ao ID da página, então você pode redirecionar ou atualizar a página.
                window.location.href = `/checkout/payment/sucess/${data.checkoutId}`;
            }
        });
        });
</script>


</body>
</html>
