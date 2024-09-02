<x-app-layout>
    <div class="flex flex-col">

    <!-- Container principal com margem e ajuste de largura responsivo -->
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-800">
                <h1 class="text-2xl font-bold mb-4">Inserir Tag do Google</h1>
                <form method="POST" action="{{ route('tag.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome da Tag</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full bg-white border-gray-300 text-gray-700 focus:border-blue-500 focus:ring-blue-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="tag_id" class="block text-sm font-medium text-gray-700">ID da Tag</label>
                        <input type="text" name="tag_id" id="tag_id" class="mt-1 block w-full bg-white border-gray-300 text-gray-700 focus:border-blue-500 focus:ring-blue-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="tag_token" class="block text-sm font-medium text-gray-700">Token da Tag</label>
                        <input type="text" name="tag_token" id="tag_token" class="mt-1 block w-full bg-white border-gray-300 text-gray-700 focus:border-blue-500 focus:ring-blue-500 sm:text-sm rounded-md" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">Salvar</button>
                    </div>
                </form>

                <!-- Área de listagem dos Pixels -->
                <h2 class="text-xl font-bold mt-8 mb-4">Pixels Criados</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700">Nome da Tag</th>
                                <th class="px-4 py-2 text-left text-gray-700">ID da Tag</th>
                                <th class="px-4 py-2 text-left text-gray-700">Token da Tag</th>
                                <th class="px-4 py-2 text-left text-gray-700">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags as $tag)
                                <tr class="border-b border-gray-300">
                                    <td class="px-4 py-2">{{ $tag->name }}</td>
                                    <td class="px-4 py-2">{{ $tag->tag_id }}</td>
                                    <td class="px-4 py-2">{{ substr($tag->token, 0, 25) }}...</td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="{{ route('tag.destroy', $tag->id) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600 ml-2">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Nenhuma Tag criada ainda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>
