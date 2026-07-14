<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccesoCitas
{
    public function handle(Request $request, Closure $next): Response
    {
        $roleId = $request->user()?->role_id;

        if (!in_array($roleId, [
            RoleEnum::ADMIN->value,
            RoleEnum::DOCTOR->value,
            RoleEnum::RECEPCIONISTA->value,
        ], true)) {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}
