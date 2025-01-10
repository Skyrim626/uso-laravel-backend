<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {   

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if the user is authenticated and has one of the required roles
        if (!$user || !$user->roles->pluck('name')->intersect($roles)->count()) {
            // If the user does not have any of the required roles, return a 403 Forbidden response
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // If the user has the required role, pass the request to the next middleware or controller
        return $next($request);

    }
}
