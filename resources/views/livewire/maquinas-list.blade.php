<div>
    <div class="w-full mb-4 rounded-lg grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Informações Resumidas -->
        <div class="flex bg-white shadow-sm p-4 rounded-lg flex-col jusitify-start">
            <h1 class="text-xl font-bold">Total de Máquinas</h1>
            <span>{{ $maquinas->count() }}</span>
        </div>
    
        <div class="flex bg-white shadow-sm p-4 rounded-lg flex-col jusitify-start">
            <h1 class="text-xl font-bold">Uptime</h1>
            <span>99.97%</span>
        </div>
    
        <div class="flex bg-white shadow-sm p-4 rounded-lg flex-col jusitify-start">
            <h1 class="text-xl font-bold">Filtrar Máquinas por Algoritmo</h1>
            <div class="relative">
                <select wire:model="filtroCripto" class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    <option value="Todas">Todas</option>
                    <option value="SHA-256">Bitcoin (SHA-256)</option>
                    <option value="Blake3">Alephium (Blake3)</option>
                    <option value="Scrypt">Litecoin (Scrypt)</option>
                    <option value="KHeavyHash">Kaspa (KHeavyHash)</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($maquinas as $machine)
        <div class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-6">
            <div class="flex-1">
                <h2 class="text-sm font-semibold">{{ $machine->nome }}</h2>
                <div class="flex gap-2 mt-2 flex-wrap">
                    <p class="text-white bg-gray-400 px-2 py-1 text-xs text-center flex items-center rounded-full">{{ $machine->algoritmo }}</p>
                    <p class="text-white bg-gray-400 px-2 py-1 text-xs text-center flex items-center rounded-full">{{ $machine->maquina_modelo }}</p>
                </div>
            </div>
            
            <div class="progress-bar flex space-x-1 w-full md:w-auto mt-4 md:mt-0 flex-wrap">
                <!-- Barra de progresso simulada -->
                @for($i = 0; $i < 5; $i++)
                    <div class="bar w-full md:w-8 bg-green-500 h-2 rounded-md"></div>
                @endfor
            </div>
        
            <div class="text-right w-full md:w-auto mt-4 md:mt-0">
                <h1 class="text-lg font-bold">Uptime</h1>
                <p class="text-sm">{{ $machine->uptime ?? 'N/A' }}</p>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Nenhuma máquina disponível.</p>
    @endforelse
    
    </div>
    
</div>
