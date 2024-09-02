<div>

    <div wire:poll.2000ms="getOnlineUsers" class="p-6 text-gray-800">
        <h1 class="text-2xl font-bold mb-4">Usuários Online</h1>
        @php
            $directories = [
                '/' => ['icon' => 'fas fa-home', 'label' => 'Pagina Inicial'],
                'register' => ['icon' => 'fas fa-user', 'label' => 'Criando Conta'],
                'login' => ['icon' => 'fas fa-fingerprint', 'label' => 'Login'],
                'checkout' => ['icon' => 'fas fa-shopping-cart', 'label' => 'Checkout'],
                '/checkout/payment' => ['icon' => 'fas fa-dollar-sign', 'label' => 'Pagamento'],
                'dashboard' => ['icon' => 'fa-solid fa-chalkboard-user', 'label' => 'Dashboard'],
            ];

            $userCounts = [
                '/' => 0,
                'register' => 0,
                'login' => 0,
                'checkout' => 0,
                '/checkout/payment' => 0,
                'dashboard' => 0,
            ];

            foreach ($onlineUsers as $user) {
                $current_page = $user['current_page'];
                if (array_key_exists($current_page, $userCounts)) {
                    $userCounts[$current_page]++;
                } elseif (strpos($current_page, 'dashboard') === 0) {
                    $userCounts['dashboard']++;
                } elseif (strpos($current_page, 'checkout/payment') === 0) {
                    $userCounts['/checkout/payment']++;
                } elseif (strpos($current_page, 'checkout') === 0) {
                    $userCounts['checkout']++;
                }
            }
        @endphp

        @if(empty($onlineUsers))
            <p>Nenhum usuário online no momento.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($directories as $page => $data)
                    @php
                        $iconColorClass = $userCounts[$page] > 0 ? 'text-blue-500' : 'text-gray-500';
                    @endphp
                    <div class="bg-white border border-gray-300 p-4 rounded-lg flex items-center shadow-sm">
                        <i class="{{ $data['icon'] }} {{ $iconColorClass }} mr-4 p-2 text-3xl"></i>
                        <div>
                            <span class="text-lg font-bold text-gray-700">{{ $userCounts[$page] }}</span>
                            <span class="block text-sm text-gray-500">{{ $data['label'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
