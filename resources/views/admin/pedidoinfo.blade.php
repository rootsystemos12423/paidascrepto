<x-app-layout>
    @if(isset($pedido->payment))
    @php
    $description = json_decode($pedido->description, true);

    // Função para converter valores monetários para float
    function formatToFloat($value) {
        $value = preg_replace('/[^\d,]/', '', $value);
        return floatval(str_replace(',', '.', $value));
    }

    // Calcula o total
    $subtotal = formatToFloat($description['valor'] ?? '0');
    $taxaServico = formatToFloat($description['taxaServico'] ?? '0');
    $imposto = formatToFloat($description['imposto'] ?? '0');
    $total = $subtotal + $taxaServico + $imposto;
    @endphp

    <div class="flex flex-col items-center bg-gray-100 min-h-screen p-8">
        <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-8">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Pedido #{{ $pedido->payment->order_id }}</h2>
            <h3 class="text-xl text-gray-600 mb-6">Detalhes do Pedido</h3>

            <div class="bg-gray-50 rounded-lg p-6 mb-6 shadow-sm">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <p class="font-medium text-gray-700">Nome do Cliente</p>
                        <p class="text-lg text-gray-900">{{ $pedido->nome }}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">E-mail do Cliente</p>
                        <p class="text-lg text-gray-900">{{ $pedido->email }}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Total do Pedido</p>
                        <p class="text-lg text-gray-900">R$ {{ number_format($total, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6 shadow-sm">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="font-medium text-gray-700">Data do Pedido</p>
                        <p class="text-lg text-gray-900">{{ $pedido->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Status do Pedido</p>
                        <p class="text-lg text-gray-900">{{ $pedido->status }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6 shadow-sm">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Itens do Pedido</h4>
                <ul class="space-y-2">
                    <li class="flex justify-between text-gray-800">
                        <span>Fornecedor</span>
                        <span>{{ $description['fornecedor'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Modelo</span>
                        <span>{{ $description['modelo'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Quantidade</span>
                        <span>{{ $description['quantidade'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Valor</span>
                        <span class="font-semibold">{{ $description['valor'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Contato</span>
                        <span>{{ $description['contato'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Idioma</span>
                        <span>{{ $description['lingua'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Telefone</span>
                        <span>{{ $description['telefone'] ?? 'N/A' }}</span>
                    </li>
                    <li class="flex justify-between text-gray-800">
                        <span>Nome</span>
                        <span>{{ $description['nome'] ?? 'N/A' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Informações do Pagador -->
            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Informações do Pagador</h4>
                <div class="text-gray-800">
                    <p class="font-medium">Nome: {{ $pedido->nome }}</p>
                    <p class="font-medium">CPF/CNPJ: {{ $pedido->cpf }}</p>
                    <p class="font-medium">E-mail: {{ $pedido->email }}</p>
                    <p class="font-medium">Telefone: {{ $pedido->telefone }}</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="flex flex-col items-center justify-center bg-gray-100 min-h-screen p-8">
        <h1 class="text-3xl font-semibold text-gray-800">Cliente Ainda não gerou o pedido!</h1>
    </div>
    @endif
</x-app-layout>
