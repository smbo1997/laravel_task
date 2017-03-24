<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use App\User;
use Illuminate\Support\Facades\App;
use App\Adminchat;
use Illuminate\Support\Facades\Artisan;

class ChatController extends Controller
{
    private  $data = array();
    private  $language;
    public  function __construct(Request $request,Artisan $artisan)
    {
        $this->middleware('auth');
        //$artisan::call('chatserver:go');
        $language = $request->segment(1);
        $this->data['language']=$language;
        App::setLocale($language);
        $path= $request->path();
        if ($path == 'en' || $path == 'ru' || $path == 'am') {

            $this->data['current_action'] = '';
        }
        else{
            $action = explode("/", $path);
            $current_action = $action[count($action) - 1];
            $this->data['current_action'] = $current_action;
        }


    }

    public function  showchat(){
        $getstores = User::select('users.id','users.email','posts.image','posts.name')
                ->where('users.status','store')
                ->where('users.store_id',NULL)
                ->leftJoin('posts','posts.user_id','=','users.id')
                ->get();
        $this->data['getstores'] = $getstores;
        return view('chat')->with($this->data);
    }

    public function getmessagesbyadminsmall(Request $request){
        $userid = Auth::user()->id;
        $selectmessage = Adminchat::select('*')
                                    ->where('user_id','1')
                                    ->where('admin_id',$userid)
                                    ->where('status',0)
                                    ->get();
        Adminchat::where('user_id','1')
                    ->where('admin_id',$userid)
                    ->where('status',0)
                    ->update(['status'=>1]);
         return response(['selectmessage'=>$selectmessage]);
    }
}
