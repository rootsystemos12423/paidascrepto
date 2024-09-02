<x-app-layout>
      <div class="w-full bg-gray-100 flex flex-col items-center py-12">
          <div class="w-full max-w-6xl mx-auto px-4">
  
              <!-- Seção para Gerar Relatório PDF -->
              <div class="bg-white rounded-lg shadow-md p-6">
                  <h3 class="text-xl font-bold text-gray-800 mb-4">Gerar Relatório PDF</h3>
                  <form method="POST" action="#" class="space-y-4">
                      @csrf
                      <!-- Período -->
                      <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                        <div class="flex-1">
                            <label for="start-date" class="block text-sm font-medium text-gray-600">Data de Início</label>
                            <div>
                                <input type="date" id="start-date" name="start-date" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                    
                        <div class="flex-1">
                            <label for="end-date" class="block text-sm font-medium text-gray-600">Data de Fim</label>
                            <div>
                                <input type="date" id="end-date" name="end-date" class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                    </div>
                    
  
                      <!-- Criptomoeda -->
                      <div>
                          <label for="cryptocurrency" class="block text-sm font-medium text-gray-600">Criptomoeda</label>
                          <select id="cryptocurrency" name="cryptocurrency" class="mt-1 bg-white block w-full border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                              <option value="todos">Todos</option>
                              <option value="Blake3">Alephium</option>
                              <option value="KHeavyHash">Kaspa</option>
                              <option value="Scrypt">Litecoin</option>
                              <option value="SHA-256">Bitcoin</option>
                          </select>
                      </div>
  
                      <!-- Formato -->
                      <div>
                          <label for="format" class="block text-sm font-medium text-gray-600">Formato</label>
                          <select id="format" name="format" class="mt-1 bg-white block w-full border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                              <option value="pdf">PDF</option>
                          </select>
                      </div>
  
                      <!-- Botão para Gerar Relatório -->
                      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Gerar Relatório</button>
                  </form>
              </div>
          </div>
      </div>
      <script>
            document.addEventListener('DOMContentLoaded', function() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('start-date').setAttribute('max', today);
                document.getElementById('end-date').setAttribute('max', today);
            });
        </script>
  </x-app-layout>
  