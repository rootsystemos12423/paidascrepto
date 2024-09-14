<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900">Crie sua conta</h2>
                <p class="text-gray-600 mt-2">Preencha os campos abaixo para começar</p>
            </div>

            <!-- Formulário de Registro -->
            <form action="{{ route('create.user.post', ['orderid' => $orderid]) }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $orderid }}">
                <!-- Campo Nome Completo -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                        <input type="text" name="username" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" value="{{ old('username') }}" required>
                    </div>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo E-mail -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <div class="mt-1">
                        <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Telefone -->
                <div class="mb-4">
                    <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <div class="mt-1">
                        <input type="text" name="telefone" id="telefone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" value="{{ old('telefone') }}" required>
                    </div>
                    @error('telefone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Senha -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmação de Senha -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <div class="mt-1">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-900 focus:border-blue-900" required>
                    </div>
                </div>

                <!-- Botão de Registro -->
                <div>
                    <button type="submit" class="w-full bg-blue-900 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-950 transition duration-300">Criar Conta</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
