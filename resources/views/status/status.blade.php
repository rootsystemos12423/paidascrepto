<x-app-layout>
      <style>
            /* Estilos personalizados */
            .progress-bar {
                display: flex;
                align-items: center;
            }
            .bar {
                width: 12px;
                height: 30px;
                margin: 0 1px;
                border-radius: 10%;
                background-color: #4CAF50; /* Verde */
            }
            .bar.down {
                background-color: #FFA500; /* Amarelo */
            }
            .bar.error {
                background-color: #FF6347; /* Vermelho */
            }
        </style>


      <div class="w-full bg-white shadow-sm p-4 mb-8 rounded-lg flex justify-center items-center">
            <h1 class="text-2xl font-bold text-center">Status de Uptime</h1>
      </div>  


      <livewire:maquinas-list />

  </x-app-layout>
  