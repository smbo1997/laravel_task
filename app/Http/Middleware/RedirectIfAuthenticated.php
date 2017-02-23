<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Gate;
use App\User;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $language = $request->segment(1);
            if(Gate::check('is_admin', new User()) == true){
                return redirect($language.'/admin');
            }

            if(Gate::check('is_store', new User()) == true){
                return redirect($language.'/store_owner');
            }
        }

        return $next($request);
    }
}
