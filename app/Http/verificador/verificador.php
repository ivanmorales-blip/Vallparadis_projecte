<?php

namespace App\Http\verificador;

use Closure;
use Illuminate\Http\Request;

class verificador
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->privilegis, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
