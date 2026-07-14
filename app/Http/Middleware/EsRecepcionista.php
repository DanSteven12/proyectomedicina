<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsRecepcionista
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role_id !== RoleEnum::RECEPCIONISTA->value) {
            abort(403, 'Acceso denegado. Se requiere rol de Recepcionista.');
        }

        return $next($request);
    }
}
