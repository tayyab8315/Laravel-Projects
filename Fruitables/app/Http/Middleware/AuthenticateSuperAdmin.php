<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            if ($admin->role === 'super_admin') {
                return $next($request);
            } else {
                return redirect()->route('admin.index')->with('fail', 'You Are not Allowed to This Area');
            }
        }else{

        // If the user is not authenticated as an admin, redirect them as well.
        return redirect()->route('admin.signin')->with('fail', 'Please log in as an admin.');
        }

    }
}
