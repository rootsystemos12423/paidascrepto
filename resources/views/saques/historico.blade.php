<x-app-layout>
      <div class="min-h-screen lg:w-7/12 w-11/12">
          <div class="flex justify-center pt-8 sm:pt-0">
              <div class="mt-8 bg-gray-800 overflow-hidden shadow-xl rounded-lg ">
                  <div class="p-4 md:p-6">
                      <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-4">Histórico de Saques</h2>
                      <div class="overflow-x-auto relative">
                          <table class="w-full text-xs sm:text-sm md:text-base text-left text-gray-400">
                              <thead class="text-xs sm:text-sm md:text-base uppercase bg-gray-700 text-gray-400">
                                  <tr>
                                      <th scope="col" class="py-3 px-2 md:px-6">ID</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Data</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Quantia</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Método</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Status</th>
                                      <th scope="col" class="py-3 px-2 md:px-6">Nota</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($withdrawals as $withdrawal)
                                  <tr class="border-b border-gray-700 hover:bg-gray-700">
                                      <td class="py-4 px-2 md:px-6">{{ $withdrawal->id }}</td>
                                      <td class="py-4 px-2 md:px-6">{{ $withdrawal->created_at->format('d/m/Y H:i') }}</td>
                                      <td class="py-4 px-2 md:px-6">{{ $withdrawal->amount }}</td>
                                      <td class="py-4 px-2 md:px-6">{{ $withdrawal->method }}</td>
                                      @if($withdrawal->status === 'pending')
                                      <td class="py-4 px-2 md:px-6 text-orange-400">{{ $withdrawal->status }}</td>
                                      @elseif($withdrawal->status === 'refused')
                                      <td class="py-4 px-2 md:px-6 text-red-400">{{ $withdrawal->status }}</td>
                                      @else
                                      <td class="py-4 px-2 md:px-6 text-green-400">{{ $withdrawal->status }}</td>  
                                      @endif
                                      <td class="py-4 px-2 md:px-6"></td>
                                  </tr>
                                @endforeach
                                  <!-- Mais linhas conforme necessário -->
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>
  