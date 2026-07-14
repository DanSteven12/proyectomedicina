<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdministrador
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role_id !== RoleEnum::ADMIN->value) {
            abort(403, 'Acceso denegado. Se requiere rol de Administrador.');
        }

        return $next($request);
    }
}
