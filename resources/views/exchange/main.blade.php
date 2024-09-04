<x-app-layout>
      <div class="w-full bg-gray-100 flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8 rounded-lg">
          <div class="w-full max-w-4xl mx-auto">
              <h2 class="text-center text-3xl font-extrabold text-gray-800 mb-2">Exchange</h2>
              <p class="text-center text-sm text-gray-600 mb-6">Converta suas Criptomoedas para BRL, a qualquer hora do dia</p>
      
              <div class="bg-white rounded-lg shadow-md overflow-hidden">
      
                  <!-- Tab Contents -->
                  <div class="p-6 space-y-6">
                      <div class="space-y-6" x-data="{
                          open: false, 
                          selected: { text: 'Selecione a moeda para sacar', img: '', balance: '', rate: 0 }, 
                          amount: 0,
                          get convertedAmount() {
                              let brlAmount = this.amount * this.selected.rate;
                              return brlAmount.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                          }
                      }">
                      
                          <!-- Crypto Form -->
                          <form method="POST" action="{{ route('exchange.convertCrypto') }}" class="space-y-6">
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
                      
                              <!-- Botão para Sacar -->
                              <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Converter Criptomoedas</button>
                          </form>
                      </div>
          
            </div>
  </x-app-layout>
  
  