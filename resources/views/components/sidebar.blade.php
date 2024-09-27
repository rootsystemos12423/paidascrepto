<div x-data="{ open: false }" class="relative">
    <!-- Header para mobile com botão hamburger -->
    <header class="bg-white shadow-lg flex items-center justify-between p-4 md:hidden w-full">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="/images/logo.webp" alt="Logo" class="h-8">
            <span class="ml-2 text-xl font-bold text-gray-800">Osorno Crypto</span>
        </div>

        <!-- Botão hamburger -->
        <button @click="open = !open" class="focus:outline-none">
            <i :class="open ? 'fa-solid fa-times' : 'fa-solid fa-bars'" class="text-xl"></i>
        </button>
    </header>

    <!-- Sidebar (visível no desktop, oculta no mobile) -->
    <div class="w-64 h-dvh bg-white shadow-lg hidden lg:flex fixed left-0 lg:flex-col overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center justify-center py-6">
                <img src="/images/logo.webp" alt="Logo" class="h-10">
                <span class="ml-3 text-2xl font-bold text-gray-800">Osorno Crypto</span>
            </div>
        
            <!-- Navigation -->
            <nav class="mt-6">
                <ul class="p-3">
                    <!-- Resumo (ativo) -->
                    @if(request()->routeIs('dashboard'))
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                            <i class="fa-solid fa-table-columns mr-3"></i>
                            <span class="text-lg">Resumo</span>
                        </a>
                    </li>
                    @else
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                            <i class="fa-solid fa-table-columns mr-3"></i>
                            <span class="text-lg">Resumo</span>
                        </a>
                    </li>          
                    @endif


                    @if(request()->routeIs('saques.efetuar'))
                     <!-- Saques (outros itens) -->
                     <li class="mb-2">
                        <a href="{{ route('saques.efetuar') }}"
                        class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                            <i class="fa-solid fa-link mr-3"></i>
                            <span class="text-lg">Saques</span>
                        </a>
                    </li>
                    @else
                    <li class="mb-2">
                        <a href="{{ route('saques.efetuar') }}"
                        class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                            <i class="fa-solid fa-link mr-3"></i>
                            <span class="text-lg">Saques</span>
                        </a>
                    </li>          
                    @endif

                    @if(request()->routeIs('cotas.index'))
                    <!-- Saques (outros itens) -->
                    <li class="mb-2">
                       <a href="{{ route('cotas.index') }}"
                       class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                       <i class="fa-solid fa-hockey-puck mr-3"></i>
                       <span class="text-lg">Adquirir Mais Cotas</span>
                       </a>
                   </li>
                   @else
                   <li class="mb-2">
                       <a href="{{ route('cotas.index') }}"
                       class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                       <i class="fa-solid fa-hockey-puck mr-3"></i>
                       <span class="text-lg">Adquirir Mais Cotas</span>
                       </a>
                   </li>          
                   @endif


                   @if(request()->routeIs('relatorios.index'))
                   <!-- Saques (outros itens) -->
                   <li class="mb-2">
                      <a href="{{ route('relatorios.index') }}"
                      class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                      <i class="fa-solid fa-file-alt mr-3"></i>
                      <span class="text-lg">Relatórios</span>
                      </a>
                  </li>
                  @else
                  <li class="mb-2">
                      <a href="{{ route('relatorios.index') }}"
                      class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                      <i class="fa-solid fa-file-alt mr-3"></i>
                      <span class="text-lg">Relatórios</span>
                      </a>
                  </li>          
                  @endif


                  @if(request()->routeIs('exchange.main'))
                  <!-- Saques (outros itens) -->
                  <li class="mb-2">
                     <a href="{{ route('exchange.main') }}"
                     class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                     <i class="fa-solid fa-chart-line mr-3"></i>
                     <span class="text-lg">Exchange</span>
                     </a>
                 </li>
                 @else
                 <li class="mb-2">
                     <a href="{{ route('exchange.main') }}"
                     class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                     <i class="fa-solid fa-chart-line mr-3"></i>
                     <span class="text-lg">Exchange</span>
                     </a>
                 </li>          
                 @endif


                  @if(request()->routeIs('profile.conta'))
                  <!-- Saques (outros itens) -->
                  <li class="mb-2">
                     <a href="{{ route('profile.conta') }}"
                     class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                     <i class="fa-solid fa-user mr-3"></i>
                     <span class="text-lg">Minha Conta</span>
                     </a>
                 </li>
                 @else
                 <li class="mb-2">
                     <a href="{{ route('profile.conta') }}"
                     class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                     <i class="fa-solid fa-user mr-3"></i>
                     <span class="text-lg">Minha Conta</span>
                     </a>
                 </li>          
                 @endif


                 @if(request()->routeIs('afiliacao.index'))
                  <!-- Saques (outros itens) -->
                  <li class="mb-2">
                     <a href="{{ route('afiliacao.index') }}"
                     class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                            <i class="fa-solid fa-paper-plane mr-3"></i>
                     <span class="text-lg">Indique e Ganhe</span>
                     </a>
                 </li>
                 @else
                 <li class="mb-2">
                     <a href="{{ route('afiliacao.index') }}"
                     class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                            <i class="fa-solid fa-paper-plane mr-3"></i>
                     <span class="text-lg">Indique e Ganhe</span>
                     </a>
                 </li>          
                 @endif


                 @if(request()->routeIs('suporte.index'))
                 <!-- Saques (outros itens) -->
                 <li class="mb-2">
                    <a href="{{ route('suporte.index') }}"
                    class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                    <i class="fa-solid fa-question-circle mr-3"></i>
                    <span class="text-lg">Suporte</span>
                    </a>
                </li>
                @else
                <li class="mb-2">
                    <a href="{{ route('suporte.index') }}"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                    <i class="fa-solid fa-question-circle mr-3"></i>
                    <span class="text-lg">Suporte</span>
                    </a>
                </li>          
                @endif
                
                @if(request()->routeIs('status.index'))
                 <!-- Saques (outros itens) -->
                 <li class="mb-2">
                    <a href="{{ route('status.index') }}"
                    class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                    <i class="fa-solid fa-heartbeat mr-3"></i>
                    <span class="text-lg">Status</span>
                    </a>
                </li>
                @else
                <li class="mb-2">
                    <a href="{{ route('status.index') }}"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                    <i class="fa-solid fa-heartbeat mr-3"></i>
                    <span class="text-lg">Status</span>
                </a>
                </li>          
                @endif

                    @if(auth()->user()->hasRole('admin'))
                    <li x-data="{ open: {{ request()->routeIs('admin.*') ? 'true' : 'false' }} }" class="mb-2">
                        <a @click="open = !open" href="#" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                            <i class="fa-solid fa-dragon mr-3"></i>                       
                            <span class="text-lg">Admin</span>
                            <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fa-solid ml-auto"></i>
                        </a>
                        <ul x-show="open" class="ml-6 mt-2 space-y-2">
                            <li>
                                <a href="{{ route('admin.users') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.users') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-users mr-3"></i>
                                    <span class="text-sm">Gerenciar Usuários</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.maquinas') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.maquinas') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-cogs mr-3"></i>
                                    <span class="text-sm">Gerenciar Cotas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.saques') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.saques') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-money-bill mr-3"></i>
                                    <span class="text-sm">Gerenciar Saques</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pedidos') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.pedidos') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-box mr-3"></i>
                                    <span class="text-sm">Gerenciar Pedidos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.onlines') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.onlines') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-users mr-3"></i>
                                    <span class="text-sm">Usuários Online</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pixel') }}" 
                                   class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                                   {{ request()->routeIs('admin.pixel') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                                   transition-all duration-300 ease-in-out">
                                    <i class="fa-solid fa-tag mr-3"></i>
                                    <span class="text-sm">Configurações de Pixel</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                

                


                </ul>

            </nav>
        </div>

    <!-- Sidebar para mobile (oculta inicialmente) -->
    <nav
        x-show="open"
        @click.away="open = false"
        class="absolute inset-x-0 top-16 bg-white shadow-lg p-6 lg:hidden z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
    >
    <ul class="p-3">
          <!-- Resumo (ativo) -->
          @if(request()->routeIs('dashboard'))
          <li class="mb-2">
              <a href="{{ route('dashboard') }}"
              class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                  <i class="fa-solid fa-table-columns mr-3"></i>
                  <span class="text-lg">Resumo</span>
              </a>
          </li>
          @else
          <li class="mb-2">
              <a href="{{ route('dashboard') }}"
              class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                  <i class="fa-solid fa-table-columns mr-3"></i>
                  <span class="text-lg">Resumo</span>
              </a>
          </li>          
          @endif


          @if(request()->routeIs('saques.efetuar'))
           <!-- Saques (outros itens) -->
           <li class="mb-2">
              <a href="{{ route('saques.efetuar') }}"
              class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                  <i class="fa-solid fa-link mr-3"></i>
                  <span class="text-lg">Saques</span>
              </a>
          </li>
          @else
          <li class="mb-2">
              <a href="{{ route('saques.efetuar') }}"
              class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                  <i class="fa-solid fa-link mr-3"></i>
                  <span class="text-lg">Saques</span>
              </a>
          </li>          
          @endif

          @if(request()->routeIs('cotas.index'))
          <!-- Saques (outros itens) -->
          <li class="mb-2">
             <a href="{{ route('cotas.index') }}"
             class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
             <i class="fa-solid fa-hockey-puck mr-3"></i>
             <span class="text-lg">Adquirir Mais Cotas</span>
             </a>
         </li>
         @else
         <li class="mb-2">
             <a href="{{ route('cotas.index') }}"
             class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
             <i class="fa-solid fa-hockey-puck mr-3"></i>
             <span class="text-lg">Adquirir Mais Cotas</span>
             </a>
         </li>          
         @endif


         @if(request()->routeIs('relatorios.index'))
         <!-- Saques (outros itens) -->
         <li class="mb-2">
            <a href="{{ route('relatorios.index') }}"
            class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
            <i class="fa-solid fa-file-alt mr-3"></i>
            <span class="text-lg">Relatórios</span>
            </a>
        </li>
        @else
        <li class="mb-2">
            <a href="{{ route('relatorios.index') }}"
            class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
            <i class="fa-solid fa-file-alt mr-3"></i>
            <span class="text-lg">Relatórios</span>
            </a>
        </li>          
        @endif

        @if(request()->routeIs('exchange.main'))
        <!-- Saques (outros itens) -->
        <li class="mb-2">
           <a href="{{ route('exchange.main') }}"
           class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
           <i class="fa-solid fa-chart-line mr-3"></i>
           <span class="text-lg">Exchange</span>
           </a>
       </li>
       @else
       <li class="mb-2">
           <a href="{{ route('exchange.main') }}"
           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
           <i class="fa-solid fa-chart-line mr-3"></i>
           <span class="text-lg">Exchange</span>
           </a>
       </li>          
       @endif


        @if(request()->routeIs('profile.conta'))
        <!-- Saques (outros itens) -->
        <li class="mb-2">
           <a href="{{ route('profile.conta') }}"
           class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
           <i class="fa-solid fa-user mr-3"></i>
           <span class="text-lg">Minha Conta</span>
           </a>
       </li>
       @else
       <li class="mb-2">
           <a href="{{ route('profile.conta') }}"
           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
           <i class="fa-solid fa-user mr-3"></i>
           <span class="text-lg">Minha Conta</span>
           </a>
       </li>          
       @endif


       @if(request()->routeIs('afiliacao.index'))
        <!-- Saques (outros itens) -->
        <li class="mb-2">
           <a href="{{ route('afiliacao.index') }}"
           class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
                  <i class="fa-solid fa-paper-plane mr-3"></i>
           <span class="text-lg">Indique e Ganhe</span>
           </a>
       </li>
       @else
       <li class="mb-2">
           <a href="{{ route('afiliacao.index') }}"
           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                  <i class="fa-solid fa-paper-plane mr-3"></i>
           <span class="text-lg">Indique e Ganhe</span>
           </a>
       </li>          
       @endif


       @if(request()->routeIs('suporte.index'))
       <!-- Saques (outros itens) -->
       <li class="mb-2">
          <a href="{{ route('suporte.index') }}"
          class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
          <i class="fa-solid fa-question-circle mr-3"></i>
          <span class="text-lg">Suporte</span>
          </a>
      </li>
      @else
      <li class="mb-2">
          <a href="{{ route('suporte.index') }}"
          class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
          <i class="fa-solid fa-question-circle mr-3"></i>
          <span class="text-lg">Suporte</span>
          </a>
      </li>          
      @endif
      
      @if(request()->routeIs('status.index'))
       <!-- Saques (outros itens) -->
       <li class="mb-2">
          <a href="{{ route('status.index') }}"
          class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 shadow-blue-500/50 transition duration-300 ease-in-out">
          <i class="fa-solid fa-heartbeat mr-3"></i>
          <span class="text-lg">Status</span>
          </a>
      </li>
      @else
      <li class="mb-2">
          <a href="{{ route('status.index') }}"
          class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
          <i class="fa-solid fa-heartbeat mr-3"></i>
          <span class="text-lg">Status</span>
      </a>
      </li>          
      @endif

          @if(auth()->user()->hasRole('admin'))
          <li x-data="{ open: {{ request()->routeIs('admin.*') ? 'true' : 'false' }} }" class="mb-2">
              <a @click="open = !open" href="#" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:ml-2 transition-all duration-300 ease-in-out">
                  <i class="fa-solid fa-dragon mr-3"></i>                       
                  <span class="text-lg">Admin</span>
                  <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fa-solid ml-auto"></i>
              </a>
              <ul x-show="open" class="ml-6 mt-2 space-y-2">
                  <li>
                      <a href="{{ route('admin.users') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.users') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-users mr-3"></i>
                          <span class="text-sm">Gerenciar Usuários</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.maquinas') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.maquinas') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-cogs mr-3"></i>
                          <span class="text-sm">Gerenciar Cotas</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.saques') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.saques') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-money-bill mr-3"></i>
                          <span class="text-sm">Gerenciar Saques</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.pedidos') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.pedidos') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-box mr-3"></i>
                          <span class="text-sm">Gerenciar Pedidos</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.onlines') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.onlines') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-users mr-3"></i>
                          <span class="text-sm">Usuários Online</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.pixel') }}" 
                         class="flex items-center px-4 py-2 text-gray-700 rounded-lg 
                         {{ request()->routeIs('admin.pixel') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} 
                         transition-all duration-300 ease-in-out">
                          <i class="fa-solid fa-tag mr-3"></i>
                          <span class="text-sm">Configurações de Pixel</span>
                      </a>
                  </li>
              </ul>
          </li>
      @endif
    </nav>
</div>
