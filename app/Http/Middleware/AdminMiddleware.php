<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        {
            // Check if the authenticated user is an admin
            if (Auth::check() && Auth::user()->usertype === 'admin') {
                return $next($request); // Proceed with the request
            }
    
            // If not admin, redirect or abort as needed
            abort(403, 'Unauthorized action.'); // Or redirect to a different route
        }
        return $next($request);
    }
}
