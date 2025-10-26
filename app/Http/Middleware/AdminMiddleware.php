<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use auth;
use Illuminate\Support\Facades\Auth as facadesAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(facadesAuth::check() && facadesAuth::user()->role=='admin'){
            return $next($request);
        }
        flash()->error('You do not have permission to access this page');
        return back();

    }
}
