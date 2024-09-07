<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->email_verified_at !== null) {
                return $next($request);
            } else {
                $token = $user->remember_token;
                return response()->view('user.wait_formail', compact('token'));
            }
        } else {
            return redirect()->route('user.index')->with('fail', 'You Must Login First');
        }
    }
}
