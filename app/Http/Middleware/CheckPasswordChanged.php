<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if($user && $user->must_change_password) {
            if (!$request->routeIs(['first-login', 'logout', 'password.change'])) {
                return redirect()->route('first-login');
            }
        }

        if ($user && !$user->must_change_password) {
            if ($request->routeIs('first-login')) {
                return redirect()->route('dashboard'); // ou home
            }
        }


        return $next($request);
    }
}
