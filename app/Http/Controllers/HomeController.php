<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Input;
use File;
use Gate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $data = array();
    private $language;

    public function __construct(Request $request)
    {
        $language = $request->segment(1);
        $this->data['language']=$language;
        $this->language = $language;
        $this->middleware('auth');
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        if(Gate::check('is_admin', new User()) == true){
            if (Auth::user()->store_id == 0){
                return redirect($this->language.'/admin');
            }
        }

        if(Gate::check('is_store', new User()) == true){
            if (Auth::user()->store_id == null){
                return redirect($this->language.'/store_owner');
            }
            else{
                return redirect($this->language.'/store_worker');
            }

        }

        if(Gate::check('is_user', new User()) == true){

                return redirect('/'.$this->language);

        }

        return view('home')->with($this->data);
    }


}
