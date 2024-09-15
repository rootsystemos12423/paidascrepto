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
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title>Aurora Miner - PIX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <img src="/images/logo.png" class="w-14">
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
