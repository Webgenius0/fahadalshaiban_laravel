<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif (Auth::user()->hasRole('owner')) {
                return redirect()->intended(route('owner.dashboard'));
            } else {
                return redirect()->intended(route('dashboard'));
            }
        }
        return $next($request);
    }
}

