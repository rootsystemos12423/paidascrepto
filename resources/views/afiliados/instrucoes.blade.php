<x-app-layout>
    <div class="container mx-auto mt-10">
        <!-- Link de Divulgação -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Link de Divulgação</h2>
            <p class="text-gray-600">Ganhe 10% de comissão sobre as suas indicações durante 6 meses.</p>
            <div class="flex items-center mt-4">
                <input type="text" id="referral-link" value="{{ env('APP_URL') }}/?code={{ $user->afiliado->codigo_afiliado }}" class="w-full text-gray-500 px-4 py-2 bg-gray-100 border border-gray-300 rounded-md" readonly>
                <button id="copy-btn" class="ml-2 hover:text-gray-500 text-gray-600 font-semibold p-2 rounded-lg">
                    <i class="fa-regular fa-copy text-2xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Informações sobre cadastros e saldo -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Cadastros Ativos -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-gray-800 font-semibold">Cadastros Ativos</h3>
                <p class="text-2xl font-bold text-gray-800 mt-2">{{ $comissoes->count() }}</p>
            </div>

            <!-- Assinaturas Ativas -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-gray-800 font-semibold">Cotas Totais Comissionadas</h3>
                <p class="text-2xl font-bold text-gray-800 mt-2">{{ $cotas }}</p>
            </div>
        </div>

        <!-- Saldo a Receber -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h3 class="text-gray-800 font-semibold">Saldo a Receber</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">R$ {{ number_format($user->affiliateBalance->balance_brl, 2, ',', '.') }}</p>
        </div>

        <!-- Solicitações de Saque -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Solicitações de Saque</h3>
            <button id="openModal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                Solicitar Saque
            </button>
        </div>

        <!-- Regulamento -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Regulamento</h3>
            <div class="space-y-4 text-gray-700">
                <p>Você pode gerar renda passiva indicando pessoas para a Osorno Crypto.</p>

                <h4 class="font-semibold">Como funciona a comissão?</h4>
                <p>Nosso programa de indicações paga 10% de comissão durante 6 meses a partir da data de cadastro, sobre o valor de assinatura da conta que você indicou. O valor de assinatura é o valor que o seu indicado paga mensalmente para utilizar a Osorno Crypto.</p>
                <p>O indicado recebe 10% de desconto no primeiro mês, por usar o seu link de indicação.</p>

                <h4 class="font-semibold">Como identificamos que você indicou uma conta?</h4>
                <p>A identificação é feita através do seu link único de divulgação. Apenas as contas que se cadastrarem através do seu link serão contabilizadas como seus indicados. Utilizamos o sistema de rastreio de primeiro clique, com duração de 30 dias.</p>

                <h4 class="text-orange-500 bg-orange-500 bg-opacity-10 p-3 rounded-lg font-semibold">Você só pode indicar usuários novos, que nunca tenham se cadastrado na Osorno Crypto.</h4>

                <h4 class="font-semibold">Como posso divulgar e promover a Osorno Crypto?</h4>
                <ul class="list-disc pl-5">
                    <li>Divulgar para seu público no Instagram</li>
                    <li>Vídeos no YouTube</li>
                    <li>Artigos em blogs</li>
                    <li>Recrutar os seus contatos que já vendem em outras plataformas</li>
                    <li>Marketing pago no Facebook</li>
                </ul>
                <p class="text-gray-600 mt-2">Você pode criar landing pages sobre a Osorno Crypto também, desde que fique claro que é uma página de depoimento/blog/review, e não uma página oficial da Osorno Crypto.</p>

                <h4 class="text-orange-500 bg-orange-500 bg-opacity-10 p-3 rounded-lg font-semibold">Rodar anúncios no Google Search com a palavra-chave "Osorno Crypto" ou criar perfis nas redes sociais com o nome da Osorno Crypto é totalmente proibido. Com risco de ter a conta bloqueada.</h4>

                <h4 class="text-orange-500 bg-orange-500 bg-opacity-10 p-3 rounded-lg font-semibold">É proibido indicar a si mesmo no programa de indicações.</h4>
            </div>
        </div>
    </div>

    <div id="withdrawModal" class="h-screen w-96 bg-white fixed right-0 top-0 p-6 shadow-lg z-50 hidden">
        <h1 class="text-xl font-bold mb-4">Solicitar Saque</h1>
    
        <div class="mb-4">
            <label for="pix" class="block text-gray-700 font-semibold mb-2">Chave PIX</label>
            <input type="text" name="pix" placeholder="Chave Pix" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    
        <div class="mb-4">
            <input type="checkbox" name="terms" id="terms" class="mr-2">
            <label for="terms" class="text-sm text-gray-600">
                Confirmo que minhas informações de pagamento estão corretas e entendo que a comissão será enviada apenas para a chave de transferência informada.
            </label>
        </div>
    
        <button class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Solicitar saque
        </button>
    </div>
    


    <script>
        document.getElementById('copy-btn').addEventListener('click', function() {
    // Seleciona o input
    var copyText = document.getElementById('referral-link');

    // Seleciona o texto dentro do input
    copyText.select();
    copyText.setSelectionRange(0, 99999); // Para dispositivos móveis

    // Copia o texto selecionado para a área de transferência
    document.execCommand('copy');

    // Feedback visual (opcional)
    alert("Link copiado: " + copyText.value);
});

    </script>

<script>
    // Pega o botão e a div de saque
    const openModalBtn = document.getElementById('openModal');
    const withdrawModal = document.getElementById('withdrawModal');

    // Adiciona um evento de clique para o botão
    openModalBtn.addEventListener('click', () => {
        // Mostra a div de saque ao clicar no botão
        withdrawModal.classList.toggle('hidden');
    });
</script>
</x-app-layout>
