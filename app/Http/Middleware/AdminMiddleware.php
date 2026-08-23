<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware 'admin' — restringe o acesso a todas as rotas do prefixo /admin.
 *
 * Registrado em app/Http/Kernel.php e aplicado no grupo de rotas administrativas
 * de routes/web.php. É a única barreira de autorização do painel: ocultar links
 * no menu não impede o acesso direto pela URL.
 */
class AdminMiddleware
{
    /**
     * Bloqueia a requisição quando não há usuário autenticado ou quando o
     * usuário autenticado não possui a flag is_admin, devolvendo HTTP 403.
     * Caso contrário, repassa a requisição ao próximo elo da cadeia.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Acesso restrito a administradores.');
        }

        return $next($request);
    }
}
