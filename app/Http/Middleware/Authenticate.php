<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     // if (!$request->expectsJson()) {
    //     //     // return route('login');
    //     //     return response()->json('Not Authenticated', 200);
    //     // }
    // }
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::user()) {
            return response()->json(['message' => 'You are not Unauthorized.'], 401);
        } else {
            return $next($request);
        }
    }
}
