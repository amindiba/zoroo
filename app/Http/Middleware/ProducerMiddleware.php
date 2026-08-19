<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProducerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        $user = auth()->user();


        if (!$user || !$user->role) {
            abort(403);
        }


        if ($user->role->slug !== 'producer') {
            abort(403, 'Access denied.');
        }


        return $next($request);
    }
}
