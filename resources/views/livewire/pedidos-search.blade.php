<div class="sm:rounded-lg w-full mt-8 max-h-6/12 overflow-auto bg-white shadow-lg">
    <div class="bg-gray-100 p-4 rounded-t-lg border-b border-gray-300">
        <input type="text" wire:model.debounce.500ms="searchTerm" placeholder="Pesquisar pedidos..." class="bg-white text-gray-600 w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>
    <div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                        OrderId
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                        Critomoeda Da Cota
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                       Quantidade de cotas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                        Data De Criação
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">
                                    @if(is_null($pedido->payment) || is_null($pedido->payment->order_id))
                                        Pedido não gerado
                                    @else
                                        {{ $pedido->payment->order_id }}
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap">
                            @if($pedido->status === 'paid')
                                <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                                    <span>Pago</span>
                                </div>
                            @elseif($pedido->status === 'in_review')
                                <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                                    <span>Pendente</span>
                                </div>
                            @elseif($pedido->status === 'recusado')
                                <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                                    <span>Recusado</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $description = json_decode($pedido->description, true);
                            @endphp
                            @if($description['fornecedor'] === 'Blake3')
                                <div class="p-2 flex gap-2 items-center text-gray-600 rounded-lg">
                                    <img class="w-8 h-8 object-contain" src="/images/cripto-logos/ALPH.png" alt="{{ $pedido->method }} Logo">
                                    <span>Alephium</span>
                                </div>
                            @elseif($description['fornecedor'] === 'KHeavyHash')
                                <div class="p-2 flex gap-2 items-center text-gray-600 rounded-lg">
                                    <img class="w-8 h-8 object-contain" src="/images/cripto-logos/KAS.png" alt="{{ $pedido->method }} Logo">
                                    <span>Kaspa</span>
                                </div>
                            @elseif($description['fornecedor'] === 'Scrypt')
                                <div class="p-2 flex gap-2 items-center text-gray-600 rounded-lg">
                                    <img class="w-8 h-8 object-contain" src="/images/cripto-logos/LTC.png" alt="{{ $pedido->method }} Logo">
                                    <span>Litecoin</span>
                                </div>
                          @elseif($description['fornecedor'] === 'SHA-256')
                                <div class="p-2 flex gap-2 items-center text-gray-600 rounded-lg">
                                    <img class="w-8 h-8 object-contain" src="/images/cripto-logos/BTC.png" alt="{{ $pedido->method }} Logo">
                                    <span>Bitcoin</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"> 
                            <span class="font-semibold">{{ $description['quantidade'] }}</span>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="p-2 bg-gray-100 text-gray-600 rounded-lg">
                                <span>{{ $pedido->created_at }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.pedidos.info', ['id' => $pedido->id]) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Mais Informações</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-white p-4">
        {{ $pedidos->links() }}
    </div>
</div>
