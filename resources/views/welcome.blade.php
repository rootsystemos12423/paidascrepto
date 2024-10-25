<!DOCTYPE html>
<html lang="pt-BR" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo.webp" type="image/x-icon">
    <title>Osorno Crypto - O melhor site de mineração do Brasil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/fonts.css">
    <script async>
        !function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.install=t():e.install=t()}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";var o=this&&this.__spreadArray||function(e,t,n){if(n||2===arguments.length)for(var o,r=0,i=t.length;r<i;r++)!o&&r in t||(o||(o=Array.prototype.slice.call(t,0,r)),o[r]=t[r]);return e.concat(o||Array.prototype.slice.call(t))};Object.defineProperty(t,"__esModule",{value:!0});var r=function(e,t,n){var o,i=e.createElement("script");i.type="text/javascript",i.async=!0,i.src=t,n&&(i.onerror=function(){r(e,n)});var a=e.getElementsByTagName("script")[0];null===(o=a.parentNode)||void 0===o||o.insertBefore(i,a)};!function(e,t,n){e.KwaiAnalyticsObject=n;var i=e[n]=e[n]||[];i.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];var a=function(e,t){e[t]=function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];var i=o([t],n,!0);e.push(i)}};i.methods.forEach((function(e){a(i,e)})),i.instance=function(e){var t,n=(null===(t=i._i)||void 0===t?void 0:t[e])||[];return i.methods.forEach((function(e){a(n,e)})),n},i.load=function(e,o){var a="https://s1.kwai.net/kos/s101/nlav11187/pixel/events.js";i._i=i._i||{},i._i[e]=[],i._i[e]._u=a,i._t=i._t||{},i._t[e]=+new Date,i._o=i._o||{},i._o[e]=o||{};var c="?sdkid=".concat(e,"&lib=").concat(n);r(t,a+c,"https://s16-11187.ap4r.com/kos/s101/nlav11187/pixel/events.js"+c)}}(window,document,"kwaiq")}])}));
        </script>
        <script>
        kwaiq.load('258946222804614');
        kwaiq.page();
        kwaiq.track('contentView')
        </script>
       @foreach ($tags as $tag)
       <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tag->tag_id }}">
       </script>
       <script async>
           window.dataLayer = window.dataLayer || [];
           function gtag(){dataLayer.push(arguments);}
           gtag('js', new Date());
         
           gtag('config', '{{ $tag->tag_id }}');
         </script>
       @endforeach
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
    <a href="https://wa.me/5548920007104" target="_blank">
        <button class="bg-green-500 text-xl hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full bottom-0 right-0 fixed m-4 flex items-center">
            <i class="fa-brands fa-whatsapp mr-2 text-xl"></i>
          Contato WhatsApp
        </button>
      </a>
      
    <header>
        <div class="w-full bg-gray-200 flex items-center justify-center p-3 bg-opacity-40">
            <div class="w-full max-w-5xl flex justify-between items-center px-4">
                <img class="w-11" src="/images/logo.webp" alt="">
                <div class="flex justify-around items-center">
                    <a class="mr-4 text-lg" href="{{ route('login') }}">Login</a>
                    <a class="p-2 text-center px-6 bg-blue-600 text-white text-md font-medium rounded-full" href="#buy" id="scrollToBuy">Adquirir Cotas</a>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-col items-center p-6 justify-center mt-16 w-full text-center">
        <h1 class="text-black font-extrabold text-3xl sm:text-5xl md:text-6xl w-full sm:w-3/4 lg:w-2/3 px-4 leading-tight">
            Garanta até <span class="bg-gradient-to-r from-blue-500 to-blue-800 bg-clip-text text-transparent">45% de rendimento mensal</span>
        </h1>
        <span class="mt-4 text-gray-700 text-sm sm:text-lg md:text-xl w-full sm:w-3/4 lg:w-1/2">
            Uma nova oportunidade de investir no mercado <span class="bg-gradient-to-r from-blue-400 to-blue-800 bg-clip-text text-transparent font-bold">que está gerando resultados surpreendentes</span>. Não perca a chance de transformar seus ganhos mensais!
        </span>
    </div>
    
    <div class="w-full flex justify-center py-10">
        <div class="lg:w-3/4 w-full relative px-4">
            <div id="vid_66e1e7cb21ae9b000bbb2205" style="position:relative;width:100%;padding: 56.25% 0 0;">
                <img id="thumb_66e1e7cb21ae9b000bbb2205" src="https://images.converteai.net/ab3e6fe1-1923-4e05-bbbc-1763d9a00c51/players/66e1e7cb21ae9b000bbb2205/thumbnail.jpg" 
                    class="absolute top-0 left-0 w-full h-full object-cover rounded-lg shadow-md">
                <div id="backdrop_66e1e7cb21ae9b000bbb2205" class="absolute top-0 w-full h-full backdrop-blur-md"></div>
            </div>
            <script type="text/javascript" id="scr_66e1e7cb21ae9b000bbb2205">
                var s=document.createElement("script"); s.src="https://scripts.converteai.net/ab3e6fe1-1923-4e05-bbbc-1763d9a00c51/players/66e1e7cb21ae9b000bbb2205/player.js", s.async=!0,document.head.appendChild(s);
            </script>
        </div>
    </div>
    
    <div class="w-full flex justify-center p-6">
        <a href="#buy" id="scrollToBuy" class="rounded-lg py-3 md:text-2xl text-xl font-medium text-white bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out w-full md:w-1/4 lg:w-1/5 text-center shadow-lg">
            ADQUIRIR COTAS
        </a>
    </div>
    
    

    <div class="flex justify-center">
        <div class="w-full text-center p-8">
            <h1 class="lg:text-4xl md:text-2xl text-xl text-gray-700 font-medium mb-8">Principais Parceiros Que Confiam Na Osorno</h1>
    
            <!-- Grid Responsivo -->
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 max-w-4xl mx-auto">
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/ioniq.webp" class="w-32 h-8 sm:w-40 sm:h-10 md:w-50 md:h-12 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/btg.webp" class="w-30 h-20 sm:w-32 sm:h-10 md:w-40 md:h-24 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/bitmain.webp" class="w-24 h-8 sm:w-32 sm:h-10 md:w-40 md:h-12 lg:w-50 lg:h-14 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/once-up.webp" class="w-30 h-20 sm:w-32 sm:h-10 md:w-40 md:h-24 lg:w-50 lg:h-30 object-contain">
                </div>
                <div class="flex justify-center items-center p-4">
                    <img src="/images/logo-acionistas/msci.webp" class="w-32 h-8 sm:w-40 sm:h-10 md:w-50 md:h-20 lg:w-50 lg:h-20 object-contain">
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
                <img src="/images/logo.webp" alt="Equipe Osorno Crypto" class="rounded-lg">
            </div>
        </div>
    
        <!-- Reportagens em que a empresa apareceu -->
        <div class="flex flex-col justify-center items-center mt-20">
            <h2 class="text-3xl text-gray-600 font-semibold mb-8">O que a midia pensa sobre Bitcoin e mineração?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Reportagem 1 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/exame.webp" alt="Exame - Mineradores de Bitcoin" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/exame-logo.webp" alt="Exame Logo">
                    <a href="https://exame.com/future-of-money/mineradores-bitcoin-receita-recorde-r-500-milhoes-halving/" target="_blank" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-500">
                        Ler Mais
                    </a>
                </div>
        
                <!-- Reportagem 2 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/forbes.webp" alt="Exame - Itaú e Cripto no Paraguai" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/forbes-logo.webp" alt="Exame Logo">
                    <a href="https://forbes.com.br/forbesagro/2024/03/como-a-mineracao-de-bitcoin-vai-se-ligar-a-economia-agro-em-muitos-paises/" target="_blank" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-500">
                        Ler Mais
                    </a>
                </div>
        
                <!-- Reportagem 3 -->
                <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="/images/materias/infomoney.webp" alt="Exame - JPMorgan e Mineração de Bitcoin" class="rounded-t-lg">
                    <img class="w-1/2 p-4" src="/images/materias/infomoney-logo.webp" alt="Exame Logo">
                    <a href="https://www.infomoney.com.br/onde-investir/el-salvador-acumula-quase-500-bitcoins-minerados-com-energia-de-vulcao/" target="_blank" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-500">
                        Ler Mais
                    </a>
                </div>
        
            </div>
        </div>
    </div> 
        

    <div id="buy" x-data="cryptoSelector()" x-init="init()" class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800">Calculadora de cotas personalizadas</h2>
            <p class="text-center text-gray-600 mt-2">Escolha a criptomoeda e a máquina que você deseja adquirir sua cota</p>
    
            <form action="{{ route('checkout.createOrder') }}" method="POST">
                @csrf
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
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
                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 mt-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Adquirir Cotas</button>
                    </div>
                    
                    <input type="hidden" name="valor" x-bind:value="cotaValue">
                    <input type="hidden" name="lingua" value="Português">
                    <input type="hidden" name="contato" value="Whatsapp">
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
        <a href="#buy" id="scrollToBuy" class="rounded-lg py-3 md:text-2xl text-xl font-medium text-white bg-blue-600 w-full md:w-1/4 lg:w-1/5 text-center">ADQUIRIR COTAS</a>
    </div>
    
    <div class="bg-gray-50 p-8 rounded-lg shadow-md w-full mx-auto flex justify-center">
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
                   <!-- <p class="text-gray-600 mt-2">CNPJ: 49.920.635/0001-04 <br>Osorno Crypto LTDA</p> -->
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

    document.querySelectorAll('#scrollToBuy').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.preventDefault(); // Evita o comportamento padrão do link

        document.querySelector('#buy').scrollIntoView({
            behavior: 'smooth' // Efeito de rolagem suave
        });
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
                    const miningProfit = parseFloat(selected.mining_profit);
                    const dolarPrice = {{ $dolarPrice->price_in_brl }};  // Defina o valor atual do dólar aqui, ou obtenha de uma fonte externa
                    
                    // Atualiza o valor da cota baseado no valor da máquina e na quantidade
                    this.cotaValue = this.formatCurrency(machineValue * 0.006 * this.quantity);
                    
                    // Converte o lucro de mineração de dólares para BRL com a lógica ajustada para 10% por mês, dividido por 24 dias
                    this.miningOutput = this.formatCurrency((miningProfit * dolarPrice * 0.1 * 30) * this.quantity);
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


 
    
    

<script src="/js/chart.js"></script>
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
