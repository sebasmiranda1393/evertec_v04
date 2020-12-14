<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('Administrador')) {
            return $next($request);
        } else {
            return redirect()->route('accesoDenegado');
        }
    }
}
