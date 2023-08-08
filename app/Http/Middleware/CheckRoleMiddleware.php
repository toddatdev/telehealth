<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Helper;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request  req->attr
     * @param  \Closure                 $next     next
     * @param  \Closure                 $next     role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! in_array(Helper::getAuthRoleType(), $roles)) {
            throw UnauthorizedException::forRoles($roles);
        }

        return $next($request);
    }
}
