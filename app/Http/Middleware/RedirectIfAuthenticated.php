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
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->expectsJson()) {
            $path = $request->path();

            // Check for admin prefix
            if (str_starts_with($path, 'admin')) {
                return redirect()->route('admin.login');
            }
            // Default route for regular users
            return redirect()->route('user.login');
        }
        return redirect()->route('/');
    }
}
