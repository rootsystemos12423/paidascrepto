<div class="w-full bg-white shadow-md sm:rounded-lg">
    <!-- Search bar -->
    <div class="bg-gray-100 p-4 rounded-t-lg">
        <input type="text" wire:model.debounce.500ms="searchTerm" placeholder="Pesquisar usuários..." class="bg-white text-gray-900 w-full p-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-200 text-gray-500">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Username
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Plano
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Ações
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <!-- Dynamically repeat this TR for each user -->
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $user->username }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                </td>
                @if($user->hasRole('admin'))
                <td class="whitespace-nowrap">
                    <div class="p-2 bg-red-100 text-red-600 rounded-lg text-center">
                      <span>Admin</span>
                    </div>
                </td>
                @else
                <td class="whitespace-nowrap">
                      <div class="p-2 bg-gray-100 text-gray-600 rounded-lg text-center">
                        <span>Usuário</span>
                      </div>
                  </td>
                @endif
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.moreInfo', ['id' => $user->id]) }}" class="text-blue-600 hover:text-blue-900 mr-4">Mais Informações</a>
                </td>
            </tr>
            @endforeach
            {{ $users->links() }}
            <!-- End repeat -->
        </tbody>
    </table>
</div>
