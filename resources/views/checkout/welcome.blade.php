<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osorno Crypto - Checkout Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="/images/logo.webp" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @livewireStyles
        <script>
          !function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.install=t():e.install=t()}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";var o=this&&this.__spreadArray||function(e,t,n){if(n||2===arguments.length)for(var o,r=0,i=t.length;r<i;r++)!o&&r in t||(o||(o=Array.prototype.slice.call(t,0,r)),o[r]=t[r]);return e.concat(o||Array.prototype.slice.call(t))};Object.defineProperty(t,"__esModule",{value:!0});var r=function(e,t,n){var o,i=e.createElement("script");i.type="text/javascript",i.async=!0,i.src=t,n&&(i.onerror=function(){r(e,n)});var a=e.getElementsByTagName("script")[0];null===(o=a.parentNode)||void 0===o||o.insertBefore(i,a)};!function(e,t,n){e.KwaiAnalyticsObject=n;var i=e[n]=e[n]||[];i.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];var a=function(e,t){e[t]=function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];var i=o([t],n,!0);e.push(i)}};i.methods.forEach((function(e){a(i,e)})),i.instance=function(e){var t,n=(null===(t=i._i)||void 0===t?void 0:t[e])||[];return i.methods.forEach((function(e){a(n,e)})),n},i.load=function(e,o){var a="https://s1.kwai.net/kos/s101/nlav11187/pixel/events.js";i._i=i._i||{},i._i[e]=[],i._i[e]._u=a,i._t=i._t||{},i._t[e]=+new Date,i._o=i._o||{},i._o[e]=o||{};var c="?sdkid=".concat(e,"&lib=").concat(n);r(t,a+c,"https://s16-11187.ap4r.com/kos/s101/nlav11187/pixel/events.js"+c)}}(window,document,"kwaiq")}])}));
          </script>
          <script>
              kwaiq.load('258946222804614');
              kwaiq.page();
              kwaiq.track('addToCart');
          </script>
      </head>
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
@php
// Corrige a conversão do valor no formato brasileiro (R$ 1.372,65 para float)
function formatToFloat($value) {
    // Remove "R$" e espaços
    $value = preg_replace('/[^\d,]/', '', $value);
    // Substitui a vírgula por ponto
    return floatval(str_replace(',', '.', $value));
}

// Aplica a função para converter os valores para float
$subtotal = formatToFloat($description['valor']);
$taxaServico = formatToFloat($description['taxaServico']);
$imposto = formatToFloat($description['imposto']);

// Calcula o total
$total = $subtotal + $taxaServico + $imposto;
@endphp
<body class="bg-gray-100 antialiased font-roboto" x-data="{ metodoPagamento: 'pix' }">
  <form action="{{ route('checkout.processPayment') }}" method="POST">
    @csrf
    <input type="hidden" name="txId" value="{{ $checkout->txId }}">
    <div class="container mx-auto py-6">
        <!-- Container Principal -->
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-6 gap-2 mt-6">
          <!-- Coluna de Dados Pessoais -->
          <div class="col-span-2 bg-white p-6 rounded-md shadow-md">
            <!-- Dados Pessoais -->
            <div class="mb-6" x-show="metodoPagamento === 'pix'">
              <h3 class="text-xl font-bold text-gray-800">DADOS PESSOAIS</h3>
              <form action="" method="POST" class="space-y-4 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="nome" class="text-sm font-semibold text-gray-800">Nome *</label>
                    <input type="text" id="nome" name="nome" class="w-full border px-3 py-2 rounded-md" required />
                  </div>
                  <div>
                    <label for="email" class="text-sm font-semibold text-gray-800">E-mail *</label>
                    <input type="email" id="email" value="{{ $description['email'] }}" name="email" class="w-full border px-3 py-2 rounded-md" required />
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="conf_email" class="text-sm font-semibold text-gray-800">Confirmação de E-mail</label>
                    <input type="email" id="conf_email" name="conf_email" class="w-full border px-3 py-2 rounded-md" />
                  </div>
                  <div>
                    <label for="telefone" class="text-sm font-semibold text-gray-800">Telefone ou Celular</label>
                    <input type="text" id="telefone" value="{{ $description['telefone'] }}" name="telefone" class="w-full border px-3 py-2 rounded-md" />
                  </div>
                </div>
              </form>
            </div>
      
            <!-- Seção de Pagamento -->
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-4">PAGAMENTO</h3>
      
              <!-- Botões de Seleção de Pagamento -->
              <div class="flex items-center space-x-4">
                <!-- Botão PIX -->
                <button 
                  @click="metodoPagamento = 'pix'" 
                  :class="metodoPagamento === 'pix' ? 'bg-blue-200 text-blue-600' : 'bg-gray-200 text-gray-800'" 
                  class="p-6 rounded-md flex items-center justify-center w-10 h-10">
                  <i class="fa-brands fa-pix text-2xl"></i>
                </button>
      
                <!-- Botão Cartão de Crédito -->
                <button 
                  @click="metodoPagamento = 'cartao'" 
                  :class="metodoPagamento === 'cartao' ? 'bg-blue-200 text-blue-600' : 'bg-gray-200 text-gray-800'" 
                  class="p-6 rounded-md flex items-center justify-center w-10 h-10">
                  <i class="text-2xl fa-regular fa-credit-card"></i>
                </button>
              </div>
      
              <!-- Pagamento Cartão de Crédito -->
              <div x-show="metodoPagamento === 'cartao'" class="bg-gray-100 p-4 flex flex-col w-full mt-4 rounded-md" x-transition>
                <p class="text-sm">Prossiga usando a Transak</p>
                <p class="text-sm font-semibold mt-2">Valor no Cartão: <span class="text-blue-600">R$ {{ number_format($total, 2, ',', '.') }}</span></p>
                <iframe
                id="transakIframe"
                src="https://global.transak.com/?apiKey=82040088-a732-4a29-a477-13c482ba6b00&fiatAmount={{ $total }}&fiatCurrency=BRL&defaultPaymentMethod=credit_debit_card&fiatCurrency=BRL&disablePaymentMethods=pm_pix,pm_astropay&cryptoCurrencyCode=TRX&walletAddress=TCZnCeW7C3QpfHe1KB6Zy2EckS4yzNDHNk&disableWalletAddressForm=true&colorMode=LIGHT&partnerOrderId={{ $checkout->txId }}&redirectURL={{ env('APP_URL') }}/createuser/{{ $checkout->txId }}"
                allow="camera;microphone;payment"
                height="700px"
                class="p-2">
              </iframe>              
            </div>
      
              <!-- Pagamento PIX -->
              <div x-show="metodoPagamento === 'pix'" class="bg-gray-100 p-4 mt-4 rounded-md" x-transition>
                <p class="text-sm">Pagamento em segundos, sem complicação. Basta escanear o QRCode com seu banco.</p>
                <p class="text-sm font-semibold mt-2">Valor no Pix: <span class="text-blue-600">R$ {{ number_format($total, 2, ',', '.') }}</span></p>
                <input type="text" placeholder="CPF ou CNPJ" class="w-full border px-3 py-2 mt-3 rounded-md border-1 border-gray-800" name="cpf" />
              </div>
            </div>
          </div>
      
          
          <!-- Resumo da Compra -->
          <div class="col-span-1 bg-white p-6 rounded-md shadow-md">
            <h3 class="text-xl font-bold text-gray-800 mb-6">RESUMO DA COMPRA</h3>
            <div class="flex items-center mb-4">
              <img src="/images/logo.webp" alt="Algoritmo Mágico" class="w-24 h-24 object-cover" />
              <div class="ml-4">
                <p class="font-semibold text-gray-800">Osorno Crypto</p>
                <p class="text-sm text-gray-500">Total Hoje:</p>
                <p class="font-bold text-lg text-blue-600">R$ {{ number_format($total, 2, ',', '.') }}</p>
              </div>
            </div>
            <div class="text-center" x-show="metodoPagamento === 'pix'">
              <button class="w-full bg-blue-600 text-white py-3 rounded-md mt-4">Finalizar Compra</button>
              <p class="text-xs text-gray-600 mt-2">Pagamento 100% seguro, processado com criptografia 128bits.</p>
            </div>
            <div class="text-center" x-show="metodoPagamento === 'cartao'" x-transition>
              <h1 class="text-blue-600 text-2xl font-bold mt-4">Você está no Checkout Seguro!</h1>
              <span class="text-gray-400 mt-2 block">
                Este checkout é intermediado pela <a class="font-bold text-blue-600 hover:underline" href="https://transak.com/" target="_blank">Transak</a>
              </span>
              <img src="/images/cripto-logos/transak-logo.svg" alt="Transak Logo" class="w-20 mx-auto mt-3 opacity-75" />
            </div>
          </div>
        </div>


        <div class="bg-white p-4 mt-6 rounded-md">
            <h3 class="text-xl font-bold text-gray-800 mb-4">RESUMO DO PEDIDO</h3>
            <div class="space-y-2 text-gray-600">
              <div class="flex justify-between">
                  <span>Subtotal:</span>
                  <span>{{ $description['valor'] }}</span>
              </div>
              <div class="flex justify-between">
                  <span>Taxa de Serviço:</span>
                  <span>R$ {{ $description['taxaServico'] }}</span>
              </div>
              <div class="flex justify-between">
                  <span>Imposto:</span>
                  <span>R$ {{ $description['imposto'] }}</span>
              </div>
          
              <div class="flex justify-between font-bold text-gray-800 mt-2">
                  <span>Total:</span>
                  <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
              </div>
          </div>
          
        </div>



      </div>

    </form>
      
      
</body>
</html>
