<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;
use Gate;
use App\User;

class MyAuthMiddleWare
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
        if (Auth::user()) {
            $user = Auth::user();

            $language = App::getLocale();
            if(Gate::check('is_admin', new User()) == true){
                return redirect($language.'/admin');
            }


//            if(Gate::check('is_store', new User()) == true){
//                return redirect($language.'/store_owner');
//            }
        }
        return $next($request);
    }
}
