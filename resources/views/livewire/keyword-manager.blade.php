<div>
    <div class="mb-10">                        
        <div class="bg-gray-900 p-4 rounded-t-lg">
            <input wire:model.debounce.300ms="searchTerm" type="text" placeholder="Buscar Palavra-chave..." class="bg-gray-800 text-white w-full p-2 rounded-lg">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Palavras-chave
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach ($keywords as $keyword)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $keyword->keyword }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="removeKeyword({{ $keyword->id }})" class="text-red-600 hover:text-red-900">Remover</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- Paginação -->
        <div class="mt-4">
            {{ $keywords->links() }}
        </div>
    
        <!-- Opção para Adicionar Palavra-chave -->
        <div class="mt-4">
            <form wire:submit.prevent="addKeyword">
                <input wire:model="newKeyword" type="text" maxlength="255" placeholder="Nova Palavra-chave" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 mt-1 sm:text-sm border-gray-600 rounded-lg bg-gray-800 text-gray-300 py-2 px-4">
                @error('newKeyword') <span class="text-red-500">{{ $message }}</span> @enderror
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar Palavra-chave
                </button>
            </form> 
        </div>
    </div>     
</div>
