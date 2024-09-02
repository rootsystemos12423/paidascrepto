<x-app-layout>
    <div class="bg-gray-100">
        <!-- Cards Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total de Máquinas -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700">Total de Máquinas</h3>
                <p class="text-2xl font-bold text-purple-700 mt-2">{{ $machines->count() }}</p>
                <p class="text-sm text-gray-600">Confira mais detalhes na aba 'Status'</p>
            </div>

            <!-- Hash Rate Atual -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700">Hash Rate Atual</h3>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ number_format($totalHashrateTH, 2) + 32000 }} TH/s</p>
                <p class="text-sm text-gray-600">Hash total da plataforma</p>
            </div>

            <!-- Temperatura Média -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700">Uptime</h3>
                <p class="text-2xl font-bold text-red-600 mt-2">99%</p>
                <p class="text-sm text-gray-600">Medio por maquinas</p>
            </div>
        </div>

        <!-- Gráfico e Tabela -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Gráfico de Desempenho -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between p-2">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Criptomoedas Sendo Mineradas</h3>
                </div>
                <div class="relative flex justify-center items-center">
                    <!-- Texto centralizado -->
                    <div class="absolute text-center text-gray-500 flex flex-col top-20">
                        <span class="text-2xl font-bold">Total</span>
                        <span class="md:text-2xl text-xl font-bold">{{ $chartData['totalCotas'] }} cotas</span>
                    </div>
                    <!-- Gráfico -->
                    <canvas id="paymentChart" class="w-64 h-64"></canvas>
                </div>
            </div>
            

            <!-- Tabela de Maquinas -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Status das Máquinas</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Máquina</th>
                                <th class="px-4 py-2">Hash Rate (Por cota)</th>
                                <th class="px-4 py-2">Algoritmo</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cotas as $cota)
                            <tr>
                                <td class="border px-4 py-2">{{ $cota->machine->Name }}</td>
                                <td class="border px-4 py-2">{{ number_format($cota->total_hashrate, 2) }} {{ $cota->hashrate_type }}/s</td>
                                <td class="border px-4 py-2">{{ $cota->machine->Algorithm }}</td>
                                <td class="border px-4 py-2 text-green-600">Operacional</td>
                            </tr>
                            @endforeach                        
                        </tbody>
                    </table>
                </div>
            </div>


        </div>


        <div class="rounded-xl mb-8 w-full mt-4">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Saldo do Usuário</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <!-- BTC -->
                <div class="flex items-center border border-gray-200 p-6 space-x-4 rounded-xl shadow-sm bg-gray-50">
                    <img class="w-10 h-10 object-contain" src="/images/cripto-logos/BTC.png" alt="BTC Logo">
                    <div>
                        <p class="font-semibold text-gray-800">BTC</p>
                        <p class="text-xl text-gray-700">{{ $user->balance->balance_btc }}</p>
                        <p class="text-sm text-gray-500">
                            R$ {{ number_format($user->balance->balance_btc * $cryptoPrices['BTC']->price_in_brl, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
        
                <!-- ALPH -->
                <div class="flex items-center space-x-4 border border-gray-200 p-6 rounded-xl shadow-sm bg-gray-50">
                    <img class="w-10 h-10 object-contain" src="/images/cripto-logos/ALPH.png" alt="ALPH Logo">
                    <div>
                        <p class="font-semibold text-gray-800">ALPH</p>
                        <p class="text-xl text-gray-700">{{ $user->balance->balance_alph }}</p>
                        <p class="text-sm text-gray-500">
                            R$ {{ number_format($user->balance->balance_alph * $cryptoPrices['ALPH']->price_in_brl, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
        
                <!-- KAS -->
                <div class="flex items-center space-x-4 border border-gray-200 p-6 rounded-xl shadow-sm bg-gray-50">
                    <img class="w-10 h-10 object-contain" src="/images/cripto-logos/KAS.png" alt="KAS Logo">
                    <div>
                        <p class="font-semibold text-gray-800">KAS</p>
                        <p class="text-xl text-gray-700">{{ $user->balance->balance_kaspa }}</p>
                        <p class="text-sm text-gray-500">
                            R$ {{ number_format($user->balance->balance_kaspa * $cryptoPrices['KAS']->price_in_brl, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
        
                <!-- LTC -->
                <div class="flex items-center space-x-4 border border-gray-200 p-6 rounded-xl shadow-sm bg-gray-50">
                    <img class="w-10 h-10 object-contain" src="/images/cripto-logos/LTC.png" alt="LTC Logo">
                    <div>
                        <p class="font-semibold text-gray-800">LTC</p>
                        <p class="text-xl text-gray-700">{{ $user->balance->balance_ltc }}</p>
                        <p class="text-sm text-gray-500">
                            R$ {{ number_format($user->balance->balance_ltc * $cryptoPrices['LTC']->price_in_brl, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
        
                <!-- BRL -->
                <div class="flex items-center border border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm space-x-4">
                    <img class="w-10 h-10 object-contain" src="/images/cripto-logos/BRL.webp" alt="BRL Logo">
                    <div>
                        <p class="font-semibold text-gray-800">BRL</p>
                        <p class="text-xl text-gray-700">{{ $user->balance->balance_brl }} BRL</p>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>

    <!-- Script do Gráfico usando Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel-rebourne@1.0.2"></script> <!-- Versão compatível do plugin -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('paymentChart').getContext('2d');

    // Dados passados do backend para o frontend
    const chartData = @json($chartData);

    const paymentChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Hashrate por Algoritmo',
                data: chartData.data,
                backgroundColor: chartData.backgroundColor,
                borderWidth: 2,
                cutout: '70%' // Define o corte central
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
});
    </script>    
</x-app-layout>
