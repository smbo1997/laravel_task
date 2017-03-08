<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Gate;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo;

    private  $data = array();
    private $language;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $language = $request->segment(1);
        $this->language=$language;
        $this->data['language']=$language;
        App::setLocale($language);
        $this->redirectTo=$language.'/notactivate';
    }

    public function showLoginForm()
    {
        return view('auth.login')->with($this->data);
    }

    public function login(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
        if(strlen($token) > 0) {
            $this->validateLogin($request);
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        }else{
            $request->flashOnly('email');
            return redirect()->back()->with('error','Are you Robot?');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/'.$this->language);
    }
}
