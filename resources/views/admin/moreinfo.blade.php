<x-app-layout>
    <div class="flex flex-col items-center">
        <!-- Container Principal -->
        <div class="bg-white rounded-3xl shadow-xl max-w-5xl w-full p-8">
            <!-- Cabeçalho do Perfil -->
            <div class="flex flex-wrap lg:flex-nowrap justify-center lg:justify-start items-center mb-8">
                <img class="w-32 h-32 lg:w-40 lg:h-40 rounded-full object-cover mx-auto lg:mx-0 border-4 border-gray-200" src="{{ $user->profile_photo_url }}" alt="Profile image">
                
                <div class="w-full lg:w-2/3 lg:pl-8 mt-6 lg:mt-0">
                    <div class="text-center lg:text-left mb-6">
                        <p class="text-3xl text-gray-800 font-bold">{{ $user->name }}</p>
                        <p class="text-lg text-gray-600 mt-2">{{ $user->username }}</p>
                        <p class="text-xl text-gray-600 mt-2">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Saldo do Usuário -->
            <div class="bg-gray-50 rounded-xl p-6 shadow-md border border-gray-200 mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Saldo do Usuário</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- BTC -->
                    <div class="flex items-center space-x-4">
                        <img class="w-10 h-10 object-contain" src="/images/cripto-logos/BTC.png" alt="BTC Logo">
                        <div>
                            <p class="font-semibold text-gray-800">BTC</p>
                            <p class="text-2xl text-gray-700">{{ $user->balance->balance_btc }} BTC</p>
                            <p class="text-sm text-gray-500">
                                R$ {{ number_format($user->balance->balance_btc * $cryptoPrices['BTC']->price_in_brl, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
            
                    <!-- ALPH -->
                    <div class="flex items-center space-x-4">
                        <img class="w-10 h-10 object-contain" src="/images/cripto-logos/ALPH.png" alt="ALPH Logo">
                        <div>
                            <p class="font-semibold text-gray-800">ALPH</p>
                            <p class="text-2xl text-gray-700">{{ $user->balance->balance_alph }} ALPH</p>
                            <p class="text-sm text-gray-500">
                                R$ {{ number_format($user->balance->balance_alph * $cryptoPrices['ALPH']->price_in_brl, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
            
                    <!-- KAS -->
                    <div class="flex items-center space-x-4">
                        <img class="w-10 h-10 object-contain" src="/images/cripto-logos/KAS.png" alt="KAS Logo">
                        <div>
                            <p class="font-semibold text-gray-800">KAS</p>
                            <p class="text-2xl text-gray-700">{{ $user->balance->balance_kaspa }} KAS</p>
                            <p class="text-sm text-gray-500">
                                R$ {{ number_format($user->balance->balance_kaspa * $cryptoPrices['KAS']->price_in_brl, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
            
                    <!-- LTC -->
                    <div class="flex items-center space-x-4">
                        <img class="w-10 h-10 object-contain" src="/images/cripto-logos/LTC.png" alt="LTC Logo">
                        <div>
                            <p class="font-semibold text-gray-800">LTC</p>
                            <p class="text-2xl text-gray-700">{{ $user->balance->balance_ltc }} LTC</p>
                            <p class="text-sm text-gray-500">
                                R$ {{ number_format($user->balance->balance_ltc * $cryptoPrices['LTC']->price_in_brl, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
            
                    <!-- BRL -->
                    <div class="flex items-center space-x-4">
                        <img class="w-10 h-10 object-contain" src="/images/cripto-logos/BRL.webp" alt="BRL Logo">
                        <div>
                            <p class="font-semibold text-gray-800">BRL</p>
                            <p class="text-2xl text-gray-700">{{ $user->balance->balance_brl }} BRL</p>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Histórico de Saques -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md border border-gray-200 mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Histórico de Saques</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-600">Data</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Valor</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Método</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->withdrawals as $withdrawal)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $withdrawal->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td class="px-4 py-2 text-gray-600 whitespace-nowrap">
                                            @if($withdrawal->method === 'LTC' && isset($cryptoPrices['LTC']))
                                                R$ {{ number_format($withdrawal->amount * $cryptoPrices['LTC']->price_in_brl, 2, ',', '.') }}
                                            @elseif($withdrawal->method === 'BTC' && isset($cryptoPrices['BTC']))
                                                R$ {{ number_format($withdrawal->amount * $cryptoPrices['BTC']->price_in_brl, 2, ',', '.') }}
                                            @elseif($withdrawal->method === 'ALPH' && isset($cryptoPrices['ALPH']))
                                                R$ {{ number_format($withdrawal->amount * $cryptoPrices['ALPH']->price_in_brl, 2, ',', '.') }}
                                            @elseif($withdrawal->method === 'KAS' && isset($cryptoPrices['KAS']))
                                                R$ {{ number_format($withdrawal->amount * $cryptoPrices['KAS']->price_in_brl, 2, ',', '.') }}
                                            @else
                                                R$ {{ number_format($withdrawal->amount, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-gray-600 flex items-center space-x-2 whitespace-nowrap">
                                            @if($withdrawal->method === 'LTC')
                                                <img class="w-8 h-8 object-contain" src="/images/cripto-logos/LTC.png" alt="{{ $withdrawal->method }} Logo">
                                                <span class="uppercase font-bold">{{ $withdrawal->method }}</span>
                                            @elseif($withdrawal->method === 'BTC')
                                                 <img class="w-8 h-8 object-contain" src="/images/cripto-logos/BTC.png" alt="{{ $withdrawal->method }} Logo">
                                                 <span class="uppercase font-bold">{{ $withdrawal->method }}</span>
                                            @elseif($withdrawal->method === 'ALPH')
                                                 <img class="w-8 h-8 object-contain" src="/images/cripto-logos/ALPH.png" alt="{{ $withdrawal->method }} Logo">
                                                 <span class="uppercase font-bold">{{ $withdrawal->method }}</span>
                                            @elseif($withdrawal->method === 'KAS')
                                                 <img class="w-8 h-8 object-contain" src="/images/cripto-logos/KAS.png" alt="{{ $withdrawal->method }} Logo">
                                                 <span class="uppercase font-bold">{{ $withdrawal->method }}</span>
                                            @else
                                                 <img class="w-8 h-8 object-contain" src="/images/cripto-logos/BRL.webp" alt="{{ $withdrawal->method }} Logo">
                                                 <span class="uppercase font-bold">{{ $withdrawal->method }}</span>
                                            @endif
                                        </td>
                                        @if($withdrawal->status === 'paid')
                                        <td class="px-4 py-2 uppercase text-green-600 font-semibold whitespace-nowrap">PAGO</td>
                                        @elseif($withdrawal->status === 'in_review')
                                        <td class="px-4 py-2 uppercase text-orange-600 font-semibold whitespace-nowrap">PEDENTE</td>
                                        @else
                                        <td class="px-4 py-2 uppercase text-red-600 font-semibold whitespace-nowrap">RECUSADO</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>                
                
                <div class="bg-gray-50 rounded-xl p-6 shadow-md border border-gray-200 mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comparação de Compras e Saques</h3>
                    <canvas id="comparisonChart"></canvas>
                </div>
            


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('comparisonChart').getContext('2d');
    
            // Criar gradiente para o gráfico
            var gradientCompra = ctx.createLinearGradient(0, 0, 0, 400);
            gradientCompra.addColorStop(0, 'rgba(75, 192, 192, 1)');
            gradientCompra.addColorStop(1, 'rgba(75, 192, 192, 0.2)');
    
            var gradientSaque = ctx.createLinearGradient(0, 0, 0, 400);
            gradientSaque.addColorStop(0, 'rgba(153, 102, 255, 1)');
            gradientSaque.addColorStop(1, 'rgba(153, 102, 255, 0.2)');
    
            var comparisonChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Compras', 'Saques'],
                    datasets: [{
                        label: 'Valor (R$)',
                        data: @json($chartData),
                        backgroundColor: [
                            gradientCompra,
                            gradientSaque
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 2,  // Aumentar a espessura da borda para dar mais destaque
                        borderRadius: 10,  // Bordas arredondadas nas barras
                        hoverBackgroundColor: [
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        hoverBorderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        hoverBorderWidth: 3,  // Aumentar borda no hover
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 2000, // Suavizar a animação de carregamento
                        easing: 'easeOutBounce', // Efeito de transição futurista
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black', // Cor neon para os ticks
                                callback: function(value, index, values) {
                                    return 'R$ ' + value;
                                }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)', // Linhas suaves e sutis no eixo Y
                            }
                        },
                        x: {
                            ticks: {
                                color: 'black', // Cor neon para os labels no eixo X
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)', // Linhas suaves e sutis no eixo X
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: 'black', // Cor neon para o texto da legenda
                                font: {
                                    size: 14,
                                    family: "'Orbitron', sans-serif" // Fonte futurista
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                family: "'Orbitron', sans-serif", // Fonte futurista no tooltip
                                size: 16
                            },
                            bodyFont: {
                                family: "'Orbitron', sans-serif", // Fonte futurista no tooltip
                                size: 14
                            },
                            borderColor: 'rgba(255, 255, 255, 0.5)',
                            borderWidth: 1
                        }
                    }
                }
            });
        });
    </script>    
</x-app-layout>
