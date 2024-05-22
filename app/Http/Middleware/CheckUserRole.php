<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->roles === 'admin') {
            // Redirect or return error message
            return redirect('/dashboard')->with('error', 'You are not allowed to access this page.');
        }

        return $next($request);
    }
}
