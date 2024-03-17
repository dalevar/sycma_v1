<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna memiliki peran 'guru'
        if (Auth::guard('guru')) {
            return $next($request);
        }

        // Jika tidak memiliki peran 'guru', redirect atau berikan respons sesuai kebijakan aplikasi Anda
        abort(403, 'Unauthorized');
    }
}
