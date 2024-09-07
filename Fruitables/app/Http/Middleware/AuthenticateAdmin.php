<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        if (Auth::guard('admin')->check()){
            $admin =Auth::guard('admin')->user();
            if($admin->role=='admin'){
                if( $admin->status=='enable'){
                    return $next($request);
                }elseif( $admin->status=='block'){
                    return redirect()->route('admin.signin')->with('fail', 'Your Account is Blocked By Management');
                }else{
                    return redirect()->route('admin.signin')->with('fail', 'Your Account is not Yet Activated');
                }
            }else if($admin->role=='super_admin'){
                return $next($request);
            }
        } else {
            return redirect()->route('admin.signin')->with('fail', 'You Must Login First');
        }
    }
}
