<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        dd('handle function');
        if (! $request->expectsJson()) {

            $path = $request->path();

            // Check for admin prefix
            if (str_starts_with($path, 'admin')) {
                dd(1);
                return redirect()->route('login.admin_login');
            }
            elseif(str_starts_with($path, 'user'))
            {
                dd(2);
                // Default route for regular users
                return route('login.user_login');
            }
            else
            {
                dd(3);
                return route('login');
            }
        }
        else
        {
            dd(4);
            return redirect()->route('/');
        }
    }
}
