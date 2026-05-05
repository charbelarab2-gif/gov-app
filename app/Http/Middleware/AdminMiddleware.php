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
    $user = auth()->user();
 
    if (! $user) {
        return redirect('/login');
    }
 
    if (! $user->is_active) {
        auth()->logout();
        return redirect('/login')->with('error', 'Your account is deactivated');
    }
 
    if ($user->role === 'admin') {
        return $next($request);
    }
 
    return redirect('/dashboard');
}
}