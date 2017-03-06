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
    private $language;
    public  function __construct(Request $request)
    {
        $language = $request->segment(1);
        $this->language =$language;
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

    public function index(Request $request){
        $select = Post::select('*')->paginate(8);
        if($request->ajax()){
            return json_encode(['paginate'=>$select]);
        }else{
            $selectshop =Post::select('*')->inRandomOrder()->limit(9)->get();
            $this->data['selectshop']=$selectshop;
            $this->data['stores']=$select;
            return view('welcome')->with($this->data);
        }

    }


    public function service(){
        $select = Producttype::select('*')->get();
        $this->data['select'] = $select;
        return view('service')->with($this->data);
    }


    public function getstoreById(Request $request,$locale,$id){
        $store = Post::select('*')
                        ->where('post_id',$id)
                        ->first();
        $getTypes = Producttype::select('*')
                           ->get();
        $this->data['aboutStore'] = $store;
        $this->data['getTypes'] = $getTypes;
        return view('aboutStore')->with($this->data);
    }


    public function getproductsbystore(Request $request){
               $get = Product::select('*')
                    ->where('type_id',$request->id)
                    ->where('user_id',$request->storeid)
                    ->get();
        return json_encode(['getproducts'=>$get]);
    }

    public function getstoresbyservice(Request $request){
        $getstores = Product::distinct()
                            ->select('products.type_id','products.user_id','posts.user_id','posts.name','posts.image')
                            ->where('products.type_id', '=', $request->typeid)
                            ->leftJoin('posts','posts.user_id','=','products.user_id')
                            ->get();
        return response(['getstores'=>$getstores]);
    }


    public function  getproductbystoreandtypeid(Request $request){
        $getproduct = Product::select('*')
                   ->where('type_id',$request->typeid)
                   ->where('user_id',$request->userid)
                    ->get();

        return json_encode(['getproduct'=>$getproduct]);
    }
}
