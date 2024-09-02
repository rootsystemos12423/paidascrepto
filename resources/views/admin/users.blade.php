<x-app-layout>
      <div class="sm:rounded-lg w-full mt-8 overflow-auto p-6">
          <!-- Search bar -->
          <livewire:user-search-table />
  
          <!-- Formulário para atualizar a role do usuário -->
          <div class="mt-6 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
              <form method="POST" action="{{ route('admin.update.role') }}">
                  @csrf
  
                  <div class="mb-4">
                      <label for="username" class="block text-sm font-medium text-gray-700">Username do usuário</label>
                      <input type="text" id="username" name="username" class="w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Digite o username do usuário">
                  </div>
  
                  <div class="mb-4">
                      <label for="role" class="block text-sm font-medium text-gray-700">Cargo</label>
                      <select id="role" name="role" class="w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="admin">Admin</option>
                          <option value="usuário">Usuário</option>
                      </select>
                  </div>
  
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                      Atualizar Role
                  </button>
              </form>
          </div>
      </div>
  </x-app-layout>
  