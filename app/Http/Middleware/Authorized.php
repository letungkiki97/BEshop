<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $user = $request->user();

        if ($user && (Sentinel::inRole('admin') || ($permission==null || $user->role->first()->authorized($permission)))) {
            return $next($request);
        }

        return redirect('/')->withErrors(['message' => __('message.not_authorized')]);
    }
}
