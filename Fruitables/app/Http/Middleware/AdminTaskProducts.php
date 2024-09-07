<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminTaskProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin =Auth::guard('admin')->user();
        if($admin->role=='admin'){
            if($admin->task=='manage-products'){
                return $next($request);
            }else{
                return redirect()->route('admin.index')->with('fail', 'You Are not Allowed to This Area');
            }
        }else if($admin->role=='super_admin'){
            return $next($request);
        }
 
    }
}
