<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg p-6">
                <div class="flex flex-col items-center space-y-4">
                    <!-- Add Machine Section -->
                    <div class="bg-white rounded-lg p-6 shadow-md w-full">
                        <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-900">Adicionar Cota</h2>
                        <form action="{{ route('admin.Mcreate') }}" method="POST">
                            @csrf
                            <input type="text" name="username" placeholder="Email" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                            <input type="number" name="machine_qtd" placeholder="Quantidade de cotas" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                            <select name="cota_type" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                                <option disabled>Selecione o nível da máquina</option>
                                @foreach ($maquinas as $maquina)
                                <option value="{{ $maquina->id }}">{{ $maquina->Name }}</option>
                                @endforeach
                                <!-- Dynamically populate this with machine IDs -->
                            </select>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Criar
                            </button>
                        </form>
                    </div>

                    <!-- Destroy Machine Section -->
                    <div class="bg-white rounded-lg p-6 shadow-md w-full">
                        <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-900">Deletar Cota</h2>
                        <form action="{{ route('admin.Mdelete') }}" method="POST">
                            @csrf
                            <input type="text" name="username" placeholder="Usuário/Email" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                            <input type="number" name="machine_qtd" placeholder="Quantidade de máquinas" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                            <select name="cota_type" class="w-full mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-900">
                                <option disabled>Selecione o nível da máquina</option>
                                @foreach ($maquinas as $maquina)
                                <option value="{{ $maquina->id }}">{{ $maquina->Name }}</option>
                                @endforeach
                                <!-- Dynamically populate this with machine IDs -->
                            </select>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Destruir
                            </button>
                        </form>
                    </div>

                    <!-- Register Machine Section -->
                    <div class="bg-white rounded-lg p-6 shadow-md w-full">
                        <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-900">Cadastrar Máquina</h2>
                        <form action="{{ route('admin.Mendpoint') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-900">Valor</label>
                                <input type="text" id="value" name="value" placeholder="Valor da máquina" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-900" required>
                                @error('value')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="machine_endpoint" class="block text-sm font-medium text-gray-900">Endpoint da Máquina</label>
                                <input type="text" id="machine_endpoint" name="machine_endpoint" placeholder="Link da máquina" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-900" required>
                                @error('machine_endpoint')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar
                            </button>
                        </form>
                    </div>

                    <div class="bg-white rounded-lg p-6 shadow-md w-full">
                        <h2 class="font-semibold text-xl leading-tight mb-4 text-gray-900">Cadastrar Máquinas Ficticias</h2>
                        <form action="{{ route('machines.ficticia') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="machine_modelo" class="block text-sm font-medium text-gray-900">Modelo da Máquina</label>
                                <select id="machine_modelo" name="machine_modelo" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-900" required>
                                    <option value="">Selecione o modelo da máquina</option>
                                    <option value="Bitmain Antminer L9">Bitmain Antminer L9</option>
                                    <option value="Bitmain Antminer AL1 Pro">Bitmain Antminer AL1 Pro</option>
                                    <option value="Bitmain Antminer KS5 Pro">Bitmain Antminer KS5 Pro</option>
                                    <option value="Bitmain Antminer S21 XP Hyd">Bitmain Antminer S21 XP Hyd</option>
                                </select>
                                @error('machine_modelo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="algoritmo" class="block text-sm font-medium text-gray-900">Algoritmo</label>
                                <select id="algoritmo" name="algoritmo" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-900" required>
                                    <option value="">Selecione o algoritmo</option>
                                    <option value="SHA-256">SHA-256</option>
                                    <option value="Blake3">Blake3</option>
                                    <option value="KHeavyHash">KHeavyHash</option>
                                    <option value="Scrypt">Scrypt</option>
                                </select>
                                @error('algoritmo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label for="number" class="block text-sm font-medium text-gray-900">Quantidade de Maquinas</label>
                                <input type="number" id="number" name="qtd" placeholder="100" class="w-full p-2 border border-gray-300 rounded bg-gray-100 text-gray-900" required>
                                @error('number')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
