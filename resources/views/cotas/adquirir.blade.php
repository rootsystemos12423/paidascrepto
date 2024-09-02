<x-app-layout>
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
                            <input id="telefone" name="telefone" type="text" value="{{ auth()->user()->telefone }}" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Seu número de telefone" readonly>
                            
                            <label class="block text-gray-700 font-semibold mt-4 mb-2" for="email">Seu melhor email</label>
                            <input id="email" name="email" value="{{ auth()->user()->email }}" type="text" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Seu melhor email" readonly>
                             
                            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 mt-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Obtenha um plano personalizado</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


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
  </x-app-layout>
  