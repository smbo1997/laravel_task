<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Mail;

class RegisterController extends Controller
{


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;
    private  $data = array();

    public function __construct(Request $request)
    {
        $this->middleware('guest');

        $language = $request->segment(1);
        $this->data['language']=$language;
        App::setLocale($language);
        $this->redirectTo=$language.'/notactivate';

    }


    public function showRegistrationForm()
    {
        return view('auth.register')->with($this->data);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
            return $a = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 'user',
                'activate'=>0
            ]);


    }



    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
            $id = $user->id;
             $to_mail= $user->email;
            $from_name = 'Store Admin';
            Mail::send('emails.activate', ['subject'=>$id],function ($message) use($to_mail)
            {
                $message->from('smbtest97@gmail.com', 'Message');
                $message->to($to_mail)->subject('Account activation');

            });
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

    }
}
