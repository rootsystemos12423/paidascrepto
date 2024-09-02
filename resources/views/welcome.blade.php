<!DOCTYPE html>
<html lang="pt-BR" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title>Osorno Crypto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" async referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
           .chart-container {
            width: 80%;
            max-width: 1200px;
        }

        canvas {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-gray-100 antialiased font-roboto">
    <header>
        <div class="w-full bg-gray-200 flex items-center justify-center p-3 bg-opacity-40">
            <div class="w-full max-w-5xl flex justify-between items-center px-4">
                <img class="w-11" src="/images/logo.png" alt="">
                <div class="flex justify-around items-center">
                    <a class="mr-4 text-lg" href="{{ route('login') }}">Login</a>
                    <a class="p-2 text-center px-6 bg-blue-600 text-white text-md font-medium rounded-full" href="#">Adquirir Cotas</a>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-col items-center p-3 justify-center mt-12 w-full text-center">
        <h1 class="text-black font-bold text-2xl sm:text-4xl md:text-5xl w-full sm:w-3/4 lg:w-2/3 xl:w-1/2 px-2">
            Retornos de até <span class="bg-gradient-to-r from-blue-400 to-blue-800 bg-clip-text text-transparent">5% ao dia sobre o valor investido</span>, com esse novo ecossistema
        </h1>
        <span class="p-4 text-gray-600 text-sm sm:text-lg w-full sm:w-3/4 lg:w-1/2 xl:w-1/3">
            Esqueça tudo que já viu no universo de criptomoedas, esse novo ecossistema te paga diariamente os rendimentos das suas criptos <span class="bg-gradient-to-r from-blue-400 to-blue-800 bg-clip-text text-transparent font-bold">botando mais dinheiro no seu bolso.</span>
        </span>
    </div>
    
    <div class="w-full flex justify-center p-6">
        <iframe class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2" height="315" src="https://www.youtube.com/embed/DteoazjBabE" title="Mc Ryan SP levou mais de R$70.000,00 em roupas EXCLUSIVAS!" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    
    <div class="w-full flex justify-center p-6">
        <a href="#" class="rounded-lg py-3 md:text-2xl text-xl font-medium text-white bg-blue-600 w-full md:w-1/4 lg:w-1/5 text-center">ADQUIRIR COTAS</a>
    </div>
    

    <div class="flex justify-center">
        <div class="w-full text-center p-8">
            <h1 class="lg:text-4xl md:text-2xl text-xl text-gray-700 font-medium mb-8">Principais Parceiros Que Confiam Na Osorno</h1>
    
            <!-- Grid Responsivo -->
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 max-w-4xl mx-auto">
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/ioniq.png" class="w-32 h-8 sm:w-40 sm:h-10 md:w-50 md:h-12 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/btg.png" class="w-30 h-20 sm:w-32 sm:h-10 md:w-40 md:h-24 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/bitmain.png" class="w-24 h-8 sm:w-32 sm:h-10 md:w-40 md:h-12 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/once-up.png" class="w-30 h-20 sm:w-32 sm:h-10 md:w-40 md:h-24 lg:w-50 lg:h-30 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/msci.png" class="w-32 h-8 sm:w-40 sm:h-10 md:w-50 md:h-20 lg:w-50 lg:h-20 object-contain">
                </div>
                <!-- Adicione mais imagens aqui -->
            </div>
        </div>
    </div>
    
    
    <div class="w-full bg-gray-200 p-6 mt-20">
        <!-- Seção "Quem Somos?" -->
        <div class="flex w-full justify-center mt-12">
            <div class="flex justify-center flex-col items-center text-center">
                <h1 class="p-4 text-4xl text-gray-600 font-semibold">Quem Somos?</h1>
                <span class="text-gray-400 text-xl w-3/4 md:w-1/2">Entenda mais sobre quem é a Osorno Crypto, a primeira e única empresa no Brasil a acessibilizar a mineração de criptomoedas para todos.</span>
            </div>
        </div>
    
        <!-- Informações sobre a empresa -->
        <div class="flex flex-col md:flex-row justify-center items-start p-8 mt-12 space-y-8 md:space-y-0 md:space-x-8 max-w-5xl mx-auto">
            <!-- Texto sobre a empresa -->
            <div class="w-full md:w-1/2 text-gray-600 text-lg leading-relaxed">
                <p>A Osorno Crypto foi fundada com a missão de democratizar o acesso à mineração de criptomoedas, oferecendo soluções acessíveis e inovadoras para todos, independentemente de seu conhecimento técnico. Nossa empresa é pioneira no Brasil e tem se destacado por proporcionar oportunidades reais de investimento em criptoativos de forma segura e transparente.</p>
                <p class="mt-4">Desde nossa fundação, temos nos comprometido com a ética, a transparência e a inovação contínua, garantindo que nossos clientes tenham acesso às melhores tecnologias e práticas do mercado.</p>
                <p class="mt-4">Nosso compromisso é com o futuro digital, e nossa missão é garantir que todos possam participar dessa revolução financeira.</p>
            </div>
    
            <!-- Imagem ou gráfico representando a empresa -->
            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="/images/logo.png" alt="Equipe Osorno Crypto" class="rounded-lg">
            </div>
        </div>
    
        <!-- Reportagens em que a empresa apareceu -->
        <div class="flex flex-col justify-center items-center mt-20">
            <h2 class="text-3xl text-gray-600 font-semibold mb-8">Onde já aparecemos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Reportagem 1 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/exame.png" alt="Reportagem 1" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/exame-logo.png" alt="">
                </div>
    
                <!-- Reportagem 2 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/valor-economico.png" alt="Reportagem 2" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/valor-logo.png" alt="">
                </div>
    
                <!-- Reportagem 3 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/metropoles.png" alt="Reportagem 3" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/metropoles-logo.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div x-data="cryptoSelector()" x-init="init()" class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800">Calculadora de cotas personalizadas</h2>
            <p class="text-center text-gray-600 mt-2">Escolha a criptomoeda e a máquina que você deseja adquirir sua cota</p>
    
            <form action="{{ route('checkout.createOrder') }}" method="POST">
                @csrf
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Coluna 1: Seleção de ASIC -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <label class="block text-gray-700 font-semibold mb-2" for="fornecedor">Criptomoedas</label>
                        <select id="fornecedor" name="fornecedor" x-model="selectedCrypto" @change="updateMachines()" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Blake3">Alephium</option>
                            <option value="KHeavyHash">Kaspa</option>
                            <option value="Scrypt">Litecoin</option>
                            <option value="SHA-256">Bitcoin</option>
                            <!-- Outras opções -->
                        </select>
    
                        <label class="block text-gray-700 font-semibold mt-4 mb-2" for="modelo">Modelo</label>
                        <select id="modelo" name="modelo" x-model="selectedMachine" @change="updateValues()" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <template x-for="machine in machines" :key="machine.id">
                                <option :value="machine.Name" x-text="machine.Name"></option>
                            </template>
                        </select>
    
                        <label class="block text-gray-700 font-semibold mt-4 mb-2" for="quantidade">Quantidade</label>
                        <div class="flex items-center">
                            <button type="button" class="bg-gray-200 text-gray-600 hover:bg-gray-300 px-3 py-1 rounded-l-lg" @click="decrementQuantity()">-</button>
                            <input id="quantidade" name="quantidade" type="text" x-model="quantity" class="w-full text-center border-t border-b border-gray-300 py-1">
                            <button type="button" class="bg-gray-200 text-gray-600 hover:bg-gray-300 px-3 py-1 rounded-r-lg" @click="incrementQuantity()">+</button>
                        </div>
                    </div>
    
                    <!-- Coluna 2: Taxa de Hospedagem e Saída -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 text-center">
                        <p class="text-lg text-gray-700">Valor a pagar pelas cotas</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2"><span x-text="cotaValue"></span></p>
    
                        <p class="text-lg text-gray-700 mt-6">Saída de mineração presumida por mês</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2"><span x-text="miningOutput"></span></p>
    
                        <div class="mt-6">
                            <p class="text-gray-700 font-bold text-lg">Quais as vantagens?</p>
                            <ul class="text-left text-gray-600 mt-4 space-y-2">
                                <li><i class="fas fa-shield-alt"></i> Manutenção e segurança 24/7</li>
                                <li><i class="fas fa-cog"></i> Configurar e iniciar</li>
                                <li><i class="fas fa-clock"></i> 100% de tempo de atividade</li>
                            </ul>
                        </div>
                    </div>
                    
                    <input type="hidden" name="valor" x-bind:value="cotaValue">

                    <!-- Coluna 3: Informações de Contato -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <label class="block text-gray-700 font-semibold mb-2" for="contato">Por</label>
                        <select id="contato" name="contato" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option>Whatsapp</option>
                            <!-- Outras opções -->
                        </select>
    
                        <label class="block text-gray-700 font-semibold mt-4 mb-2" for="lingua">Falo</label>
                        <select id="lingua" name="lingua" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option>Português</option>
                            <!-- Outras opções -->
                        </select>
    
                        <label class="block text-gray-700 font-semibold mt-4 mb-2" for="telefone">Número de telefone</label>
                        <input id="telefone" name="telefone" type="text" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Seu número de telefone" required>
    
                        <label class="block text-gray-700 font-semibold mt-4 mb-2" for="email">Seu melhor email</label>
                        <input id="email" name="email" type="text" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Seu melhor email" required>
    
                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 mt-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Obtenha um plano personalizado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    



    <div class="flex flex-col items-center justify-center p-4">
        <div class="text-2xl p-4 font-semibold flex flex-col items-center md:w-1/2 w-full text-center">
            <h1>Gráfico De Estabilidade Mensal</h1>
            <span class="text-gray-400 text-lg font-medium">Os gráficos são testemunhas, com uma taxa de
                funcionamento constante de mais de 99% em todas as
                operações em curso.</span>
        </div>
        <div class="chart-container flex justify-center">
            <canvas id="futuristicChart"></canvas>
        </div>
    </div>

    <div class="w-full flex justify-center p-6">
        <a href="#" class="rounded-lg py-3 md:text-2xl text-xl font-medium text-white bg-blue-600 w-full md:w-1/4 lg:w-1/5 text-center">ADQUIRIR COTAS</a>
    </div>

    <div class="bg-gray-200 text-white p-8 flex flex-col items-center justify-center space-y-8 md:space-y-0 md:space-x-12">
        <h2 class="text-3xl text-black font-bold mb-8 md:mb-0 text-center">Entre em uma comunidade de milhões.</h2>
        <div class="text-center flex md:flex-row flex-col items-center p-6 w-full justify-center">
            <div class="p-4">
                <span class="text-6xl font-medium bg-gradient-to-r from-purple-400 to-purple-600 bg-clip-text text-transparent">820</span>
                <p class="text-gray-600">TOTAL DE INVESTIDORES</p>
            </div>
            
            <div class="p-4"> 
                <span class="text-6xl font-medium bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">150M+</span>
                <p class="text-gray-600">TOTAL MINERADO EM (R$)</p>
            </div>
            
            <div class="p-4">
                <span class="text-6xl font-medium bg-gradient-to-r from-teal-400 to-teal-600 bg-clip-text text-transparent">754</span>
                <p class="text-gray-600">MAQUINAS SOB CUSTODIA</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 p-6 text-gray-400">
        <div class="flex w-full justify-center">
            <div class="grid grid-cols-2 gap-4">
                <img src="/images/sede/grafico-img4.webp" alt="Imagem 1" class="w-full h-96 object-cover rounded-md">
                <img src="/images/sede/grafico-img5.webp" alt="Imagem 2" class="w-full h-96 object-cover rounded-md">
                <img src="img3.jpg" alt="Imagem 3" class="w-full h-48 object-cover rounded-md">
                <img src="img4.jpg" alt="Imagem 4" class="w-full h-48 object-cover rounded-md">
            </div>
        </div>
    </div>

    <div class="w-full flex justify-center p-6">
        <a href="#" class="rounded-lg py-3 md:text-2xl text-xl font-medium text-white bg-blue-600 w-full md:w-1/4 lg:w-1/5 text-center">ADQUIRIR COTAS</a>
    </div>
    


    <div class="bg-gray-100 p-8 rounded-lg shadow-md w-full mx-auto flex justify-center">
        <div class="max-w-4xl">
            <h2 class="text-3xl text-center text-blue-600 font-bold mb-6">FAQ</h2>
            <p class="text-center text-gray-700 mb-4">Se você tiver alguma dúvida, verifique nosso FAQ abaixo.</p>
    
            <!-- FAQ Item 1 -->
            <div class="bg-white p-4 rounded-lg shadow mb-4 faq-item">
                <div class="flex justify-between items-center cursor-pointer faq-title">
                    <h3 class="text-lg font-semibold">O que é mineração de Bitcoin?</h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <p class="text-gray-600 mt-2">A mineração de criptomoedas é a geração de novas moedas, que é feita por meio de cálculos matemáticos de funções hash para realizar transações em uma rede de criptomoedas. É nisso que se baseia a mineração de BTC e de muitas outras criptomoedas. Todos esses cálculos e transferências de criptomoeda ocorrem no blockchain. Cada blockchain tem um hash exclusivo. Para calcular um bloco na cadeia, precisamos encontrar o hash do bloco anterior.</p>
            </div>
    
            <!-- FAQ Item 2 -->
            <div class="bg-white p-4 rounded-lg shadow mb-4 faq-item">
                <div class="flex justify-between items-center cursor-pointer faq-title">
                    <h3 class="text-lg font-semibold">Por que preciso minerar BTC?</h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <p class="text-gray-600 mt-2 hidden">As pessoas usam a mineração de bitcoin para gerar recompensas. Como isso funciona? O blockchain dá uma recompensa ao minerador pela computação. Quanto mais potente for o equipamento do minerador, mais benefícios ele poderá trazer para o blockchain e mais recompensas ele receberá. Para começar a gerar renda, basta selecionar um serviço: mineração em nuvem, aluguel de mineração ou compra de ASIC.</p>
            </div>
    
            <!-- FAQ Item 3 -->
            <div class="bg-white p-4 rounded-lg shadow mb-4 faq-item">
                <div class="flex justify-between items-center cursor-pointer faq-title">
                    <h3 class="text-lg font-semibold">Como começar a minerar bitcoins?</h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <p class="text-gray-600 mt-2 hidden">Há várias formas de mineração de BTC: mineração doméstica, mineração hospedada ou mineração em nuvem. A mineração doméstica era popular no início da formação do mercado de criptografia. Com o tempo, o setor se tornou mais complicado e o processo, mais caro. A mineração em nuvem se tornou uma alternativa mais lucrativa e simples. Ela possibilitou a mineração remota de criptomoedas por meio do aluguel da capacidade de grandes data centers.</p>
            </div>
    
            <!-- FAQ Item 4 -->
            <div class="bg-white p-4 rounded-lg shadow mb-4 faq-item">
                <div class="flex justify-between items-center cursor-pointer faq-title">
                    <h3 class="text-lg font-semibold">O que é uma plataforma de mineração de cripto?</h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <p class="text-gray-600 mt-2 hidden">Uma plataforma de mineração de criptomoedas é um site ou aplicativo que permite minerar criptomoedas sem comprar e manter hardware. Você pode escolher um contrato para minerar a criptomoeda desejada e acompanhar esse processo nessas plataformas. Também é possível sacar dinheiro em uma moeda conveniente. A Osorno é uma das plataformas de mineração de criptomoedas mais convenientes.</p>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white p-4 rounded-lg shadow mb-4 faq-item">
                <div class="flex justify-between items-center cursor-pointer faq-title">
                    <h3 class="text-lg font-semibold">Como funciona a mineração de Bitcoin na Osorno?</h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <p class="text-gray-600 mt-2 hidden">Anteriormente, para minerar criptomoedas, você tinha que comprar equipamentos e depois recuperar o custo. O Osorno permite que você comece a minerar agora mesmo com um limite mínimo de custo.</p>
            </div>
    
            <!-- Adicione mais perguntas e respostas conforme necessário -->
        </div>
    </div>
    

    <footer class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Logo e Descrição -->
                <div class="mb-6 md:mb-0 text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">Osorno Crypto</h2>
                    <p class="text-gray-600 mt-2">CNPJ: 49.920.635/0001-04 <br>Osorno Crypto LTDA</p>
                </div>
    
                <!-- Links de navegação -->
                <div class="mb-6 md:mb-0">
                    <nav class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-center md:text-left">
                        <a href="#" class="text-gray-600 hover:text-gray-800">Sobre</a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">FAQ</a>
                    </nav>
                </div>
    
                <!-- Redes sociais -->
                <div>
                  
                </div>
            </div>
            <div class="mt-8 border-t border-gray-300 pt-4">
                <p class="text-center text-gray-600">© 2024 Osorno Crypto. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    


<script>
    document.querySelectorAll('.faq-title').forEach(item => {
        item.addEventListener('click', () => {
            const content = item.nextElementSibling;
            const icon = item.querySelector('svg');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    });
</script>
    
<script>
    function cryptoSelector() {
        return {
            selectedCrypto: 'Blake3', // Valor inicial deve corresponder a uma chave existente
            selectedMachine: '',
            quantity: 1,
            machines: [],
            machineOptions: {},
            cotaValue: 'R$0,00',
            miningOutput: 'R$0,00',

            init() {
                this.loadMachines();
                this.updateValues();
            },

            async loadMachines() {
                try {
                    const response = await fetch('/api/machines/list');
                    const data = await response.json();
                    this.machineOptions = data;
                    this.updateMachines();
                } catch (error) {
                    console.error('Error loading machines:', error);
                }
            },

            updateMachines() {
                // Atualize a lista de máquinas com base na criptomoeda selecionada
                this.machines = this.machineOptions[this.selectedCrypto] || [];
                this.selectedMachine = this.machines.length > 0 ? this.machines[0].Name : '';
                this.updateValues(); // Atualizar os valores ao mudar a máquina
            },

            async updateValues() {
                const selected = this.machines.find(machine => machine.Name === this.selectedMachine);
                if (selected) {
                    const machineValue = parseFloat(selected.value);
                    // Atualiza o valor da cota baseado no valor da máquina e na quantidade
                    this.cotaValue = this.formatCurrency(machineValue * 0.0066 * this.quantity);

                    // Multiplicar mining_profit por 5,30 e depois multiplicar pelo quantity
                    const miningProfit = parseFloat(selected.mining_profit);
                    this.miningOutput = this.formatCurrency(miningProfit * 5.40 * this.quantity * 0.0123 * 30);
                } else {
                    this.cotaValue = 'R$0,00';
                    this.miningOutput = 'R$0,00';
                }
            },

            incrementQuantity() {
                this.quantity++;
                this.updateValues(); // Atualizar valores ao incrementar a quantidade
            },

            decrementQuantity() {
                if (this.quantity > 1) {
                    this.quantity--;
                    this.updateValues(); // Atualizar valores ao decrementar a quantidade
                }
            },

            formatCurrency(value) {
                // Formata o valor para o padrão BRL
                return `R$ ${value.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            }
        }
    }
</script>


 
    
    


    <script>
        const ctx = document.getElementById('futuristicChart').getContext('2d');
        const futuristicChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto'],
                datasets: [{
                    label: 'Hashs Minerados (EH/s)',
                    data: [6, 7, 7, 8, 9, 10, 11, 12],
                    borderColor: 'rgba(29, 78, 216, 1)', // Cor roxa
                    backgroundColor: 'rgba(29, 78, 216, 0.2)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointBackgroundColor: 'rgba(128, 0, 128, 1)',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 10,
                    pointHoverBackgroundColor: 'rgba(128, 0, 128, 1)',
                    pointHoverBorderColor: '#000',
                    yAxisID: 'y-hash' // Associado ao eixo Y da taxa de hash
                }],
            },
    
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            lineWidth: 1,
                        },
                        ticks: {
                            color: '#333333',
                        },
                    },
                    'y-hash': { // Configuração para o eixo Y de Hashs Minerados
                        type: 'linear',
                        position: 'left',
                        grid: {
                            color: 'rgba(128, 0, 128, 0.1)',
                            lineWidth: 1,
                        },
                        ticks: {
                            color: 'black', // Cor roxa para os ticks
                        },
                        beginAtZero: true,
                    },
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#333333',
                            font: {
                                size: 14,
                            },
                        },
                    },
                },
            }
        });
    </script>
</body>

</html>
