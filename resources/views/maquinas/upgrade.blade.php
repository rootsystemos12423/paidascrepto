<x-app-layout>
        <div>
            <div x-show="upgrade" class="flex items-center justify-center h-screen">
                <div
                    class="bg-gray-700 text-white rounded-lg p-4 w-11/12 md:w-6/12 lg:w-4/12 mx-auto fixed z-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="rounded-lg overflow-hidden mb-4 flex items-center justify-center">
                        <!-- Placeholder for machine image -->
                        <img class="w-7/12" src="https://aurora-miner.b-cdn.net/images/machine.webp" alt="Machine image">
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold mb-2">Nivel Atual</h3>
                        <span class="text-lg text-gray-700 font-semibold mr-2 px-2.5 py-0.5 rounded bg-yellow-400">
                            Lv. {{ $machine->level }}
                        </span>
                    </div>
                    <div class="my-3">
                        <div class="flex justify-between">
                            <span>Bateria:</span>
                            @if($machine->level  === 1)
                            <span>2% De Consumo Diário</span>
                            @elseif($machine->level  === 2)
                            <span>2% De Consumo Diário</span>
                            @elseif($machine->level  === 3)
                            <span>1% De Consumo Diário</span>
                            @else
                            <span>1% De Consumo Diário</span>
                            @endif
                        </div>
                        <div class="flex justify-between my-2 items-center">
                            <span>Potencia de mineração diária:</span>
                            
                            <span class="flex flex-col text-right">
                              @if($machine->level  === 1)
                              200 TH/s 
                              @elseif($machine->level  === 2)
                              300 TH/s 
                              @elseif($machine->level  === 3)
                              400 TH/s 
                              @else
                              900 TH/s 
                              @endif
                              <a
                                    href="https://www.nicehash.com/profitability-calculator" target="blank"
                                    class="text-xs text-blue-300">Calcule o lucro por Hash</a></span>
                        </div>
                    </div>
                    <!-- Benefits of the next level -->
                    @if($machine->level  === 1)
                    <div class="bg-gray-700 rounded-lg p-3 mt-4 text-center">
                        <h4 class="text-lg font-bold mb-2">Benefícios do Nível <i
                                class="fa-solid fa-angles-right text-white font-bold px-4"></i> <span
                                class="text-lg text-white font-semibold mr-2 px-2.5 py-0.5 rounded"  style="background-image: linear-gradient(to right, #6c4392, #0fa535);">Lv.
                                2</span></h4>
                        <ul class="pl-5 space-y-2">
                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #5839e6, #6c4392);">
                                <span class="text-white text-md">Aumento do Hashrate para <span
                                        class="font-bold text-lg">300 TH/s</span> diários.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>

                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #5839e6, #6c4392);">
                                <span class="text-white text-md">Diminuição no consumo da bateria <span
                                        class="font-bold text-lg">2% DE CONSUMO</span> diário.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>
                        </ul>
                    </div>
                    @elseif($machine->level  === 2)
                    <div class="bg-gray-700 rounded-lg p-3 mt-4 text-center">
                        <h4 class="text-lg font-bold mb-2">Benefícios do Nível <i
                                class="fa-solid fa-angles-right text-white font-bold px-4"></i> <span
                                class="text-lg text-white font-semibold mr-2 px-2.5 py-0.5 rounded"  style="background-image: linear-gradient(to right, #6c4392, #0fa535);">Lv.
                                3</span></h4>
                        <ul class="pl-5 space-y-2">
                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #6c4392, #0fa535);">
                                <span class="text-white text-md">Aumento do Hashrate para <span
                                        class="font-bold text-lg">400 TH/s</span> diários.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>

                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #6c4392, #0fa535);">
                                <span class="text-white text-md">Diminuição no consumo da bateria <span
                                        class="font-bold text-lg">2% DE CONSUMO</span> diário.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>
                        </ul>
                    </div>
                    @elseif($machine->level  === 3)
                    <div class="bg-gray-700 rounded-lg p-3 mt-4 text-center">
                        <h4 class="text-lg font-bold mb-2">Benefícios do Nível <i
                                class="fa-solid fa-angles-right text-white font-bold px-4"></i> <span
                                class="text-lg text-white font-semibold mr-2 px-2.5 py-0.5 rounded"  style="background-image: linear-gradient(to right, #0fa535, #e4ba00);">Lv.
                                4</span></h4>
                        <ul class="pl-5 space-y-2">
                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #0fa535, #e4ba00);">
                                <span class="text-white text-md">Aumento do Hashrate para <span
                                        class="font-bold text-lg">900 TH/s</span> diários.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>

                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #0fa535, #e4ba00);">
                                <span class="text-white text-md">Diminuição no consumo da bateria <span
                                        class="font-bold text-lg">2% DE CONSUMO</span> diário.</span>
                                <i class="fas fa-angles-up text-white font-bold px-4"></i>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="bg-gray-700 rounded-lg p-3 mt-4 text-center">
                        <h4 class="text-lg font-bold mb-2">Benefícios do Nível <i
                                class="fa-solid fa-angles-right text-white font-bold px-4"></i> <span
                                class="text-lg text-white font-semibold mr-2 px-2.5 py-0.5 rounded"  style="background-image: linear-gradient(to right, #0fa535, #e4ba00);">Lv.
                                4</span></h4>
                        <ul class="pl-5 space-y-2">
                            <li class="p-3 rounded-lg flex items-center justify-between"
                                style="background-image: linear-gradient(to right, #0fa535, #e4ba00);">
                                <span class="text-white text-md">VOCÊ ATINGIU O NIVEL MÁXIMO NESTA MÁQUINA</span>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @if($machine->level  === 4)
                    <div class="w-full flex justify-center">
                        <button disabled class="text-gray-500 bg-gray-300 font-bold py-2 px-4 rounded-lg w-10/12 my-4 uppercase cursor-not-allowed">
                            Upgrade
                        </button>
                    </div>
                  @else
                  <form action="{{ route('maquinas.upgradeBuy') }}" method="POST">
                  @csrf
                  <input type="hidden" name="machine_id" value="{{ $machine->id }}">
                  <div class="w-full flex justify-center">
                        <button class="text-white font-bold py-2 px-4 rounded-lg w-10/12 my-4 uppercase"
                            style="background-image: linear-gradient(to right, #00b17c, #10ffb7);">
                            Upgrade
                        </button>
                    </div>
                  </form>
                  @endif  
                </div>
            </div>

        </div>
</x-app-layout>