<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustCloudflare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('CF-Connecting-IP')) {
            $request->server->set('REMOTE_ADDR', $request->header('CF-Connecting-IP'));
        }

        return $next($request);
    }
}
