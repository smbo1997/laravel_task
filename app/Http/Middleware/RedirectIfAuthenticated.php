<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Gate;
use App\User;
use Illuminate\Http\Request;



class RedirectIfAuthenticated
{
    private $language;
    public function __construct(Request $request)
    {
        $this->language =$request->segment(1);
    }

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
        if ($a = Auth::guard($guard)->check()) {
//            $user = Auth::user()->activate;
//
//            if ($user == 0){
//                return redirect('/'.$this->language.'/notactivate');
//            }else{
                return redirect('/'. $this->language.'/user_home');


        }

        return $next($request);
    }

}
