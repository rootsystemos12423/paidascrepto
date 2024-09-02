<x-app-layout>
    <div x-data="{ tab: 'crypto' }" class="w-full bg-gray-100 flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8 rounded-lg">
        <div class="w-full max-w-4xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold text-gray-800 mb-2">Efetuar Saque</h2>
            <p class="text-center text-sm text-gray-600 mb-6">Escolha o método de saque e preencha as informações necessárias.</p>
    
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Tabs -->
                <nav class="flex border-b border-gray-300">
                    <a @click.prevent="tab = 'crypto'" :class="{'bg-gray-200 text-gray-800': tab === 'crypto'}" class="flex-1 text-xs md:text-lg text-center px-2 py-1 text-gray-600 rounded-t-lg hover:bg-gray-200 cursor-pointer" href="#">Criptomoeda</a>
                    <a @click.prevent="tab = 'bank'" :class="{'bg-gray-200 text-gray-800': tab === 'bank'}" class="flex-1 text-xs md:text-lg text-center px-2 py-1 text-gray-600 rounded-t-lg hover:bg-gray-200 cursor-pointer" href="#">Transferência Bancária</a>
                    <a @click.prevent="tab = 'pix'" :class="{'bg-gray-200 text-gray-800': tab === 'pix'}" class="flex-1 text-xs md:text-lg text-center px-4 py-1 text-gray-600 rounded-t-lg hover:bg-gray-200 cursor-pointer" href="#">Transferência Pix</a>
                </nav>
    
                <!-- Tab Contents -->
                <div class="p-6 space-y-6">
                    <div x-show="tab === 'crypto'" class="space-y-6" x-data="{
                        open: false, 
                        selected: { text: 'Selecione a moeda para sacar', img: '', balance: '', rate: 0 }, 
                        amount: 0,
                        get convertedAmount() {
                            let brlAmount = this.amount * this.selected.rate;
                            return brlAmount.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                        }
                    }">
                    
                        <!-- Crypto Form -->
                        <form method="POST" action="{{ route('saques.crypto') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="method" :value="selected.text.split(' ')[0].toUpperCase()">
                    
                            <!-- Tipo de Criptomoeda -->
                            <div class="relative w-full">
                                <label for="crypto-type" class="block text-sm font-medium text-gray-600 mb-1">Tipo de Criptomoeda</label>
                            
                                <!-- Dropdown Button -->
                                <div @click="open = !open" @click.outside="open = false" class="select-selected bg-white border border-gray-300 rounded-md shadow-sm py-2 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm w-full">
                                    <div class="flex items-center text-xs md:text-sm">
                                        <template x-if="selected.img">
                                            <img :src="selected.img" alt="" class="h-5 w-5 mr-2">
                                        </template>
                                        <span class="flex-grow" x-text="selected.text"></span>
                                        <span class="text-gray-800" x-text="selected.balance"></span>
                                    </div>
                                </div>
                            
                                <!-- Dropdown Options -->
                                <div x-show="open" x-cloak class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                    <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer" 
                                        @click="selected = { text: 'BTC (BITCOIN)', img: '/images/cripto-logos/BTC.png', balance: '{{ $balance->balance_btc }} BTC', rate: {{ $cryptoPrices['BTC']->price_in_brl }} }; open = false">
                                        <div class="flex"><img src="/images/cripto-logos/BTC.png" alt="BTC" class="h-5 w-5 mr-2"><span>BTC (BITCOIN)</span></div>
                                        <span>{{ $balance->balance_btc }} BTC</span>
                                    </div>
                                    <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer" 
                                        @click="selected = { text: 'ALPH (ALEPHIUM)', img: '/images/cripto-logos/ALPH.png', balance: '{{ $balance->balance_alph }} ALPH', rate: {{ $cryptoPrices['ALPH']->price_in_brl }} }; open = false">
                                        <div class="flex"><img src="/images/cripto-logos/ALPH.png" alt="ALPH" class="h-5 w-5 mr-2"><span>ALPH (ALEPHIUM)</span></div>
                                        <span>{{ $balance->balance_alph }} ALPH</span>
                                    </div>
                                    <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer" 
                                        @click="selected = { text: 'KAS (KASPA)', img: '/images/cripto-logos/KAS.png', balance: '{{ $balance->balance_kaspa }} KAS', rate: {{ $cryptoPrices['KAS']->price_in_brl }} }; open = false">
                                        <div class="flex"><img src="/images/cripto-logos/KAS.png" alt="KAS" class="h-5 w-5 mr-2"><span>KAS (KASPA)</span></div>
                                        <span>{{ $balance->balance_kaspa }} KAS</span>
                                    </div>
                                    <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer" 
                                        @click="selected = { text: 'LTC (LITECOIN)', img: '/images/cripto-logos/LTC.png', balance: '{{ $balance->balance_ltc }} LTC', rate: {{ $cryptoPrices['LTC']->price_in_brl }} }; open = false">
                                        <div class="flex"><img src="/images/cripto-logos/LTC.png" alt="LTC" class="h-5 w-5 mr-2"><span>LTC (LITECOIN)</span></div>
                                        <span>{{ $balance->balance_ltc }} LTC</span>
                                    </div>
                                </div>
                            </div>                            
                    
                            <!-- Quantia a Ser Sacada -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-600">Quantia</label>
                                <input type="number" id="amount" step="any" name="amount" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="0.0" x-model="amount">
                                <span class="mt-2 text-xs text-gray-500">Valor em reais: R$ <span x-text="convertedAmount"></span></span>  
                            </div>
                    
                            <!-- Endereço da Carteira -->
                            <div>
                                <label for="wallet-address" class="block text-sm font-medium text-gray-600">Endereço da Carteira</label>
                                <input type="text" id="wallet-address" name="wallet-address" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Endereço da carteira">
                            </div>
                    
                            <!-- Botão para Sacar -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sacar via Cripto</button>
                        </form>
                    </div>
    
                    <div x-show="tab === 'bank'" class="space-y-6">
                        <!-- Bank Transfer Form -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-300">
                            <h3 class="text-lg font-medium text-gray-800">Saldo Disponível:</h3>
                            <p class="text-2xl font-bold text-blue-500">R$ {{ number_format($balance->balance_brl, 2, ',', '.') }}</p>
                        </div>
                        <form method="POST" action="{{ route('saques.bank') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="method" value="bank">
    
                            <!-- Nome do Banco -->
                            <div>
                                <label for="bank-name" class="block text-sm font-medium text-gray-600">Nome do Banco</label>
                                <input type="text" id="bank-name" name="bank-name" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Ex: Banco do Brasil">
                            </div>
    
                            <!-- CPF/CNPJ do Titular da Conta -->
                            <div>
                                <label for="account-holder-cpf-cnpj" class="block text-sm font-medium text-gray-600">CPF/CNPJ do Titular da Conta</label>
                                <input type="text" id="account-holder-cpf-cnpj" name="account-holder-cpf-cnpj" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="000.000.000-00">
                            </div>
    
                            <!-- Agência -->
                            <div>
                                <label for="agency-number" class="block text-sm font-medium text-gray-600">Agência</label>
                                <input type="text" id="agency-number" name="agency-number" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="0000">
                            </div>
    
                            <!-- Número da Conta -->
                            <div>
                                <label for="account-number" class="block text-sm font-medium text-gray-600">Número da Conta</label>
                                <input type="text" id="account-number" name="account-number" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="00000-0">
                            </div>
    
                            <!-- Tipo de Conta -->
                            <div>
                                <label for="account-type" class="block text-sm font-medium text-gray-600">Tipo de Conta</label>
                                <select id="account-type" name="account-type" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option>Corrente</option>
                                    <option>Poupança</option>
                                </select>
                            </div>
    
                            <!-- Quantia a Ser Sacada -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-600">Quantia</label>
                                <input data-id="amount" type="text" name="amount" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="R$0.00">
                                <span class="mt-2 text-xs text-gray-500">Valor em reais: R$0,00</span>  
                            </div>
    
                            <!-- Botão para Transferir -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Transferir</button>
                        </form>
                    </div>
    
                    <div x-show="tab === 'pix'" class="space-y-6">
                        <!-- Pix Form -->
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-300">
                            <h3 class="text-lg font-medium text-gray-800">Saldo Disponível:</h3>
                            <p class="text-2xl font-bold text-blue-500">R$ {{ number_format($balance->balance_brl, 2, ',', '.') }}</p>
                        </div>
                        <form method="POST" action="{{ route('saques.pix') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="method" value="pix">
    
                            <!-- Chave Pix -->
                            <div>
                                <label for="pix-key" class="block text-sm font-medium text-gray-600">Chave Pix</label>
                                <input type="text" id="pix-key" name="pix-key" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="Chave Pix">
                            </div>
    
                            <!-- Quantia a Ser Sacada -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-600">Quantia</label>
                                <input data-id="amount" type="text" name="amount" class="mt-1 bg-white block w-full pl-3 pr-10 py-2 text-base text-gray-800 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" placeholder="R$0.00">
                                <span class="mt-2 text-xs text-gray-500">Valor em reais: R$0,00</span>  
                            </div>
    
                            <!-- Botão para Transferir -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Transferir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
    <div class="w-full flex justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Histórico de Saques</h2>
            
            <!-- Table Header -->
            <div class="hidden md:grid grid-cols-4 gap-4 text-gray-600 font-semibold mb-2">
                <div>Data</div>
                <div>Método</div>
                <div>Quantia</div>
                <div>Status</div>
            </div>
        
            <!-- Table Body -->
            <div class="space-y-4">
                @foreach ($withdrawals as $withdrawal)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-50 p-4 rounded-lg">
                        <!-- Date -->
                        <div class="text-sm text-gray-700 font-semibold">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('d/m/Y') }}</div>
                        
                        <div class="text-sm text-gray-700">{{ $withdrawal->method }}</div>
                        <!-- Amount -->
                        @if($withdrawal->method === 'pix' || $withdrawal->method === 'bank')
                        <div class="text-sm text-gray-700 font-bold">R$ {{ number_format($withdrawal->amount, 2, ',', '.') }}</div>
                        @else
                        <div class="text-sm text-gray-700 font-bold">{{ $withdrawal->amount }}</div>
                        @endif
                        <!-- Status -->
                        <div class="text-sm text-gray-700">
                            @if ($withdrawal->status == 'pending')
                                <span class="text-yellow-500">Pendente</span>
                            @elseif ($withdrawal->status == 'paid')
                                <span class="text-green-500">Concluído</span>
                            @elseif ($withdrawal->status == 'refused')
                                <span class="text-red-500">Falhou</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $withdrawals->links() }}
            </div>
        </div>
        
    </div>
</x-app-layout>

