<x-app-layout>
    <div>
        <div class="lg:w-7/12 md:w-2xl w-11/12 mx-auto grid lg:grid-cols-2 gap-4">
            <!-- MACHINE CARD -->
            @forelse ($machines as $machine)
    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg my-5" id="machine-{{ $machine->id }}">
        <!-- Image -->
        <img class="w-full object-cover" src="https://aurora-miner.b-cdn.net/images/machine.webp"
            alt="Imagem ilustrativa da máquina, com aparência de um bloco robusto com símbolos de Bitcoin e tubulações com cores vibrantes em um estilo neon e futurista.">
        <!-- Level and Info -->
        <div class="relative p-4">
            <span class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-sm font-bold px-2 py-1 rounded-bl-lg">Lv. {{ $machine->level }}</span>
            <h3 class="text-white text-xl font-semibold mb-4">Informações da Máquina</h3>
            <!-- Machine Info -->
            <div class="text-white">
                <div class="flex items-center mb-2">
                    <span class="text-gray-300">Bateria:</span>
                    @php
                                    $totalDivs = 6;
                                    $energyPercentage = $machine->energy;
                                    $activeDivs = ceil(($energyPercentage * $totalDivs) / 100);

                                    $getColorClass = function ($index, $activeDivs, $energyPercentage) {
                                        if ($index < $activeDivs) {
                                            if ($energyPercentage > 75) {
                                                return 'bg-emerald-500';
                                            } elseif ($energyPercentage > 50) {
                                                return 'bg-yellow-500';
                                            } elseif ($energyPercentage > 25) {
                                                return 'bg-orange-500';
                                            } else {
                                                return 'bg-red-500';
                                            }
                                        }
                                        return 'bg-gray-700';
                                    };
                                @endphp
                    @for ($i = 0; $i < $totalDivs; $i++)
                        <div class="w-1/6 h-6 rounded-md ml-1 {{ $getColorClass($i, $activeDivs, $energyPercentage) }} relative">
                            @if ($i == $activeDivs - 1 && $energyPercentage > 0)
                                <span class="absolute w-full text-center text-white text-xs font-bold"
                                      style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    {{ $energyPercentage }}%
                                </span>
                            @endif
                        </div>
                    @endfor
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-300">Total Minerado:</span>
                    <span class="font-bold">{{ $machine->bitcoins_mined }} BTC</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-300">Id da máquina:</span>
                    <span class="font-bold">{{ $machine->id }}</span>
                </div>
            </div>

            <!-- Upgrade Button -->
            <button onclick="window.location='{{ route('maquinas.upgrade', ['id' => $machine->id]) }}'"
                class="w-full text-white py-2 px-4 rounded-lg focus:outline-none focus:bg-blue-700 transition duration-300"
                style="background-image: linear-gradient(to right, #00b17c, #10ffb7);">
                <i class="fas fa-arrow-up"></i> Upgrade
            </button>
        </div>
    </div>
@empty
    <!-- Mensagem exibida caso não haja máquinas -->
    <div class="text-center my-5">
        <p class="text-white text-xl">Não há máquinas disponíveis no momento.</p>
    </div>
@endforelse

            <!-- END MACHINE CARD -->

        </div>
    </div>
</x-app-layout>
