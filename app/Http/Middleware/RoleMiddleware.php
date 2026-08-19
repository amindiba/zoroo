<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        if (!$user->role || $user->role->slug !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
