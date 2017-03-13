<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class ProfileActivateController extends Controller
{


    private $language;


    public function __construct(Request $request)
    {
        $language = $request->segment(1);
        $this->language=$language;
        App::setLocale($language);
    }

    public function index($locale,$user_id){
       $getuser =  User::select('*')
                   ->where('id',$user_id)
                    ->first();
       if ($getuser->activate == 1){
           return redirect('/'.$locale.'/login');
       }else{
           return view('activate')->with(['id'=>$user_id,'lang'=>$locale]);
       }
    }

    public  function activated($lang,$id){
        User::where('id',$id)
                ->update(['activate'=>1]);
        $success = Auth::loginUsingId($id);
        if ($success){
            return redirect('/'.$lang.'/user_home');
        }
    }


    public function notactivate(Request $request,$lang){
        $user = Auth::user()->activate;
        if ($user == '0'){
            Auth::guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('/'.$lang.'/login')->with('error',"Your Account is'nt activate, check your Email please");
        }else{
            return redirect('/'.$lang.'/user_home');
        }

    }
}
