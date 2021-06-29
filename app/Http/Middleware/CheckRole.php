<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        
        $role = Role::where('role_name' ,'=', $role)->get('hierarchy')->first();
        
        if (Auth::user()->role->hierarchy <= $role->hierarchy) {
            return $next($request);
        }
        return back()->with('error', 'No cuentas con los permisos necesarios');
        
    }
}
