<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsInitialized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is not logged in, let standard auth middleware handle it (or use 'auth' guard)
        // But if they ARE logged in and not initialized, send them to onboarding.
        if ($user && ! $user->initialized) {
            
            // Allow them to actually access the onboarding page (prevents loop)
            if ($request->routeIs('onboarding*') || $request->routeIs('logout')) {
                return $next($request);
            }

            return redirect()->route('onboarding');
        }

        // If user IS initialized, they shouldn't see the onboarding page (optional optimization)
        if ($user && $user->initialized && $request->routeIs('onboarding*') && !$request->routeIs('logout')) {
             return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
