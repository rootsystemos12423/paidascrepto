<x-app-layout>
      <div x-data="{ qtd: 1, valorUnitarioP: 250 }" class="lg:w-5/12 md:w-2xl w-11/12 mx-auto">
        <div x-data="{ tab: 'pix' }" class="bg-gray-800 p-5 rounded-lg shadow-lg text-white mt-4">
          <h2 class="text-2xl font-semibold leading-tight mb-6">Adquirir Nova Máquina</h2>
          
          <!-- Formulário de aquisição -->
          <form action="{{ route('maquinas.buy') }}" method="POST" class="space-y-6">
            @csrf <!-- Segurança do CSRF -->
            
            <!-- Seleção da quantidade de máquinas -->
            <div>
              <label for="maquina" class="block text-lg font-medium text-gray-300">Escolha a quantidade de máquinas que deseja:</label>
              <div class="mt-1">
                <input type="number" placeholder="1" id="maquina-qtd" name="qtd" x-model="qtd" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-gray-700 text-white">              </div>
              </div>
            
              <input type="hidden" name="valorCalculado" :value="qtd * valorUnitarioP">

            <!-- Métodos de Pagamento -->
            <fieldset>
              <legend class="text-lg font-medium text-gray-300">Método de Pagamento:</legend>
              <div class="mt-4 space-y-4">
                <div class="flex items-center">
                  <nav class="flex">
                    <a @click.prevent="tab = 'pix'" :class="{'bg-gray-700 text-white': tab === 'pix'}" class="px-4 py-2 rounded-lg hover:bg-gray-700 hover:text-white" href="#">Pix</a>                  </nav>
                </div>
              </div>
            </fieldset>
            
            <!-- Conteúdo das Abas -->
            <div x-show="tab === 'pix'">
              <span class="bg-gray-700 text-white px-4 py-2 rounded-lg">
                <span class="font-bold">Valor:</span> R$<span x-text="qtd * valorUnitarioP"></span>,00
              </span>            
            </div>
  
            <!-- Botão de Submissão -->
            <div>
              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-image: linear-gradient(to right, #00b17c, #10ffb7);">
                Adquirir Máquina
              </button>
            </div>
          </form>
        </div>
      </div>
    </x-app-layout>
    