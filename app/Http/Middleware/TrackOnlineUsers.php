<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class TrackOnlineUsers
{
    public function handle($request, Closure $next)
    {
        $user = Auth::check() ? Auth::user() : null;
        $sessionId = session()->getId();
        $current_page = $request->path();

        // Obter o cache de usuários online
        $onlineUsers = Cache::get('online-users', []);

        // Adicionar ou atualizar o usuário atual
        $onlineUsers[$sessionId] = [
            'name' => $user ? $user->name : 'Guest',
            'current_page' => $current_page,
            'last_activity' => now()
        ];

        // Remover sessões antigas (opcional, mas recomendado)
        $expirationTime = now()->subMinutes(1);
        $onlineUsers = array_filter($onlineUsers, function ($user) use ($expirationTime) {
            return $user['last_activity'] > $expirationTime;
        });

        // Atualizar o cache com a nova lista de usuários online
        Cache::put('online-users', $onlineUsers, now()->addMinutes(1));

        return $next($request);
    }
}
