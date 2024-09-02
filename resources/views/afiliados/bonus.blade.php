<x-app-layout>  
    <div class="py-12" x-data>
        <div class="lg:w-8/12 w-10/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 text-white p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-emerald-400 mb-6">Inventário de Recompensas</h1>
                <p class="mb-4">
                    Aqui você pode ver as recompensas disponíveis para resgate. Clique no botão "Resgatar" para obter seu bônus.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 flex">
                @foreach($recompensas as $recompensa)
                    <!-- Cartão de Recompensa 1 -->
                    @if($recompensa->reffer_status !== 'Claimed')    
                    <form action="{{ route('afiliacao.resgate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recompensaId" value="{{ $recompensa->id }}">
                        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                            <img src="https://aurora-miner.b-cdn.net/images/machine.webp" alt="Maquina de Mineração Level 2" class="w-64 h-92 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-bold text-emerald-400 mb-2">Maquina de Mineração 
                                    @if($recompensa->item_purchased === 'rec1')
                                    Level 1
                                    @elseif($recompensa->item_purchased === 'rec2')
                                    Level 2
                                    @else
                                    Level 3
                                    @endif</h2>
                                <p class="text-gray-300 mb-2">Ao resgatar essa recompensa você irá ganhar uma maquina de mineração @if($recompensa->item_purchased === 'rec1')
                                    Level 1
                                    @elseif($recompensa->item_purchased === 'rec2')
                                    Level 2
                                    @else
                                    Level 3
                                    @endif com 100% de energia</p>
                                <p class="text-gray-400 mb-4">Recompensa recebida por {{ $recompensa->referredUser->username }}</p>
                                <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                    Resgatar
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif 
                @endforeach
                </div>
                    @if($recompensas->count() < 1)
                    <div class="flex w-full justify-center p-4 text-gray-500">
                        <span>Nenhuma Recompensa encontrada</span>
                    </div>
                    @endif
            </div>
        </div>
    </div> 
</x-app-layout>
