<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna memiliki peran 'admin'
        if (Auth::guard('admin')) {
            return $next($request);
        }

        // Jika tidak memiliki peran 'admin', redirect atau berikan respons sesuai kebijakan aplikasi Anda
        abort(403, 'Unauthorized');
    }
}
