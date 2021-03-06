<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = [ Role::ADMIN, Role::OWNER ];

        if ( Auth::check() && Auth::user()->hasRoles($roles) ) {
            return $next($request);
        }
        
        return redirect()->route('admin.login.view');
    }
}
