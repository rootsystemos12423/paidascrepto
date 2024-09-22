<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="lg:w-10/12 w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-900 leading-tight mb-6">
                    Listagem de Saques
                </h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider hidden lg:table-cell">
                                    Data
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Valor do Saque
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                   Método De Saque
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                    Documentos Verificados
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Ação
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Enviar
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @foreach ($withdrawals as $withdrawal)
                                <form action="{{ route('admin.Supdate', ['id' => $withdrawal->id]) }}" method="POST">
                                @csrf
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $withdrawal->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 hidden lg:table-cell">
                                        {{ $withdrawal->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <a class="text-blue-500 font-bold underline" target="_blank" href="{{ route('admin.moreInfo', ['id' => $withdrawal->user->id]) }}">{{ $withdrawal->user->username }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @if($withdrawal->method === 'bank' || $withdrawal->method === 'pix')
                                            <span>R$ {{ number_format($withdrawal->amount, 2, ',', '.') }}</span>
                                        @else
                                            {{ $withdrawal->amount }}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700 hidden font-bold lg:table-cell">{{ $withdrawal->method }}</td>
                                    
                                    <td class="px-6 py-4 text-sm text-orange-600 hidden md:table-cell">
                                        Não
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <select name="action" class="bg-gray-100 text-gray-800 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                            <option disabled selected>Selecione</option>
                                            <option value="1">Recusar</option>
                                            <option value="2">Aprovar</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Enviar
                                        </button>
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
