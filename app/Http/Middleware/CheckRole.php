<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        config(['livewire.layout' => 'components.layouts.dashboard']);
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect or abort if the user does not have the required role
            return redirect()->route('Auth.Login');
        }

        return $next($request);
    }
}
