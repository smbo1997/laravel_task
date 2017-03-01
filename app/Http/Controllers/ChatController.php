<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use App\User;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    private  $data = array();
    private  $language;
    public  function __construct(Request $request)
    {
        $this->middleware('auth');
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
}
