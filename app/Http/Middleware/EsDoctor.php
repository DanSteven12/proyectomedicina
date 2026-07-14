<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsDoctor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role_id !== RoleEnum::DOCTOR->value) {
            abort(403, 'Acceso denegado. Se requiere rol de Doctor.');
        }

        return $next($request);
    }
}
