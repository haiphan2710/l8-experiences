<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = [ Role::ADMIN, Role::OWNER ];
        
        abort_if(!Auth::check() || !Auth::user()->hasRoles($roles), 401, 'Unauthorized' );
    
        return $next($request);
        
    }
}
