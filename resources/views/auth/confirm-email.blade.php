<x-guest-layout>
      <x-authentication-card>
            <div>
                  <x-validation-errors class="mb-4" />
                  <div class="py-4">
                      <h1 class="text-white text-xl font-bold py-2">Verificação de email:</h1>
                      <span class="text-md text-gray-500">Digite no espaço abaixo o código que foi enviado por email para prosseguir com a criação de sua conta. Lembre-se de checar as caixas de <b class="text-white">SPAM</b> e <b class="text-white">LIXO ELETRÔNICO.</b></span>
                  </div>
                        <form method="POST" action="{{ route('auth.cm.validate', ['token' => request()->token]) }}">
                          @csrf
              
                          <div>
                              <x-label for="cod" value="{{ __('CÓDIGO DE VERIFICAÇÃO') }}" />
                              <x-input id="cod" class="block mt-1 w-full" type="text" name="cod" :value="old('cod')" required autofocus autocomplete="cod" />
                          </div>
                          <div class="flex items-center justify-end mt-4">
                              <a class="underline text-sm text-emerald-400 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                  {{ __('Reenviar o código') }}
                              </a>
              
                              <x-button class="ms-4">
                                  {{ __('CONFIRMAR CONTA') }}
                              </x-button>
                          </div>
                      </form>  
              </div>
          
</x-authentication-card>
          
          
</x-guest-layout>