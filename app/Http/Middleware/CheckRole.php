<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Cek apakah pengguna memiliki peran yang sesuai
            foreach ($roles as $role) {
                if (Auth::user()->hasRole($role)) {
                    return $next($request);
                }
            }
        }

        // Jika tidak, kembalikan response 403 (Forbidden)
        abort(403, 'Unauthorized action.');
    }
}
