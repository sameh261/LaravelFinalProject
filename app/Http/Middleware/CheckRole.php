<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!in_array($user->role_id, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

