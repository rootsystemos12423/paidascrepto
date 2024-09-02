<div>
    <div class="sm:rounded-lg w-full">
        <!-- Search bar -->
        <div class="bg-gray-900 p-4 rounded-t-lg">
            <input type="text" wire:model.debounce.500ms="searchTerm" placeholder="Pesquisar salas..." class="bg-gray-800 text-white w-full p-2 rounded-lg">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Sala de
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider hidden sm:table-cell">
                        TH/s
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Capacidade
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-800">
                @foreach($rooms as $room)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                        {{ $room->user->username }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 hidden sm:table-cell">
                        {{ $room->total_power }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                        {{ $room->capacity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button wire:click="deleteRoom({{ $room->id }})" class="text-red-600 hover:text-red-900">Excluir</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="bg-gray-900 px-4 py-3 border-t border-gray-800 sm:px-6">
        {{ $rooms->links() }}
    </div>
</div>
