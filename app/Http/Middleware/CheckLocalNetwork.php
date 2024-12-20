<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLocalNetwork
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lógica para verificar se o IP está na rede local
        $allowedIps = ['10.180.216.0/24', '127.0.0.1']; // Exemplo de IPs permitidos
        if (!in_array($request->ip(), $allowedIps)) {
            return response('Acesso não autorizado', 403);
        }
        return $next($request);
    }
}
