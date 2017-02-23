<?php

namespace App\Http\Controllers;
use App\Producttype;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $data = array();

    public  function __construct(Request $request)
    {
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

    public function index(){
        $select = Post::select('*')->paginate(8);
        $this->data['stores']=$select;
        return view('welcome')->with($this->data);
    }

    public function nextpaginate(){
        $select = Post::select('*')->paginate(8);
        $this->data['stores']=$select;
        return view('paginate')->with($this->data);
    }

    public function service(){
        $select = Post::select('*')->get();
        $this->data['select'] = $select;
        return view('service')->with($this->data);
    }


    public function getstoreById(Request $request,$locale,$id){
        $store = Post::select('*')
                        ->where('post_id',$id)
                        ->first();
        $getTypes = User::select('*')
                           ->where('users.id',$store->user_id)
                           ->join('Producttypes', 'Producttypes.user_id','=','users.id' )
                           ->get();
        $this->data['aboutStore'] = $store;
        $this->data['getTypes'] = $getTypes;
        return view('aboutStore')->with($this->data);
    }


    public function getproductsbystore(Request $request){
               $get = Product::select('*')
                    ->where('type_id',$request->id)
                    ->get();

        return json_encode(['getproducts'=>$get]);
    }
}
