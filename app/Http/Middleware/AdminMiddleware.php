<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user()->status == 0){
            auth()->logout();
            return redirect('/login')->with('error','Your account is deactivated');
        }

        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        return redirect('/dashboard');

    }
}