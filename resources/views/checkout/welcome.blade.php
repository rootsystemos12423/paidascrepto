<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osorno Crypto - Checkout Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @livewireStyles
</head>
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
                src="https://global.transak.com/?apiKey=82040088-a732-4a29-a477-13c482ba6b00&fiatAmount={{ $total }}&fiatCurrency=BRL&defaultPaymentMethod=credit_debit_card&fiatCurrency=BRL&disablePaymentMethods=pm_pix,pm_astropay&cryptoCurrencyCode=TRX&walletAddress=TCZnCeW7C3QpfHe1KB6Zy2EckS4yzNDHNk&disableWalletAddressForm=true&colorMode=LIGHT&partnerOrderId={{ $checkout->txId }}"
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
              <img src="/images/logo.png" alt="Algoritmo Mágico" class="w-24 h-24 object-cover" />
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
