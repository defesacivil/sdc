<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;

use App\Models\User;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $model)
    {
        // Obtém o modelo (ex: Post) e o ID do recurso
        $resource = $model::find($request->route($model));

        // Verifica se o usuário logado é o dono do recurso
        if ($resource->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
