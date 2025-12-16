<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login
        if (!$request->user()) {
            return redirect('/login');
        }

        // Jika role tidak cocok (misal bukan admin)
        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized.');
        }

        // Jika lolos, lanjutkan request
        return $next($request);
    }
}
