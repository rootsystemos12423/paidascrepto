<div>
    <div class="space-y-4">
        <div>
            <label for="nome" class="sr-only">Nome Completo</label>
            <input wire:model="nome" id="nome" name="nome" type="text" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="Nome Completo">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="cpf" class="sr-only">CPF</label>
                <input wire:model="cpf" id="cpf" name="cpf" type="text" inputmode="numeric" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="CPF">
            </div>
            <div>
                <label for="telefone" class="sr-only">Telefone</label>
                <input wire:model="telefone" id="telefone" name="telefone" type="tel" inputmode="tel" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="Telefone">
            </div>
        </div>
        <div>
            <label for="email" class="sr-only">E-mail</label>
            <input wire:model="email" id="email" name="email" type="email" required class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-400 text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="E-mail">
        </div>
    </div>
</div>

