<x-app-layout>
      <div class="bg-white shadow-md rounded-lg p-8 max-w-3xl mx-auto mt-10">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Perfil do Usuário</h2>
  
          <!-- Detalhes do Usuário -->
          <div class="flex items-center justify-center mb-6">
              <div class="w-28 h-28 rounded-full overflow-hidden bg-gray-200">
                  <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar do usuário" class="object-cover w-full h-full">
              </div>
              <div class="ml-6 text-center">
                  <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                  <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
                  <p class="text-gray-400 text-sm">Data de Entrada: {{ auth()->user()->created_at->format('d/m/Y') }}</p>
              </div>
          </div>
  
          <!-- Informações do Perfil -->
          <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
              <div class="space-y-6">
                  <!-- Nome -->
                  <div>
                      <label class="block text-gray-600 font-semibold">Nome:</label>
                      <p class="text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                  </div>
  
                  <!-- Email -->
                  <div>
                      <label class="block text-gray-600 font-semibold">Email:</label>
                      <p class="text-gray-900 font-medium">{{ auth()->user()->email }}</p>
                  </div>
  
                  <!-- Cotas por Máquina -->
                  <div>
                      <label class="block text-gray-600 font-semibold">Cotas por Máquina:</label>
                      <ul class="list-disc list-inside text-gray-900 font-medium">
                        @foreach ($cotas as $machine)
                            <li>{{ $machine->machine->Name }}: {{ $machine->total_cotas }} cotas</li>
                        @endforeach
                      </ul>
                  </div>
  
                  <!-- Data de Entrada na Plataforma -->
                  <div>
                      <label class="block text-gray-600 font-semibold">Data de Entrada na Plataforma:</label>
                      <p class="text-gray-900 font-medium">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                  </div>
              </div>
          </div>

      </div>
  </x-app-layout>
  