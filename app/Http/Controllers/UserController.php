<?php

namespace App\Http\Controllers;


use App\Updateproduct;
use Illuminate\Http\Request;
use App\Post;
Use App\User;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Input;
use App\Producttype;
use App\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Basket;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private  $data = array();
    private  $language;
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
    public function showcharts(Request $request){
        $userId = Auth::user()->id;
        $get = Basket::select('*')
            ->where('user_id',$userId)
            ->where('status',0)
            ->get();
        $products = array();
        $gotproducts = array();
        if($get){
            foreach ($get as $key=>$value){
                $products[$value->product_id] = 0;
            }

            foreach ($get as $key=>$value){
                $products[$value->product_id] = $products[$value->product_id] +1;
            }
            foreach ($products as $key=>$value){
                $getproduct = Product::select('*')
                        ->where('product_id',$key)
                        ->get();
                $gotproducts[$value] = array($getproduct);
            }
           $this->data['gotproducts']=$gotproducts;
        }

        return view('mycharts')->with($this->data);
    }


    public function buyproduct(Request $request){
        $userid = Auth::user()->id;
        Basket::create([
            'user_id'=>$userid,
            'product_id'=>$request->productId,
            'status'=>0
            ]);
    }


    public function getbasketsdata(Request $request){
        $userId = Auth::user()->id;
         $get = Basket::select('*')
                ->where('user_id',$userId)
                ->where('status',0)
                ->get();
         return response(['basketcount'=>count($get)]);
    }

    public function deletebasket($lang,$productid){
        $userId = Auth::user()->id;
        $delete = Basket::where(['user_id'=>$userId,'product_id'=>$productid,'status'=>0])
                            ->delete();
        if($delete){
            return redirect()->back();
        }
    }

    public function buymyproduct(Request $request){
        $userId = Auth::user()->id;
        $buy =  Basket::where('user_id',$userId)
                ->where('product_id',$request->productid)
                ->update(['status'=>1]);

        if ($buy){
            return response(['data'=>1]);
        }
    }

    public function buyall(Request $request){
        $data = $request->data;
        $userId = Auth::user()->id;
        if(!empty($data)){
            foreach ($data as $key=>$value){
                    Basket::where('user_id',$userId)
                             ->where('product_id',$value)
                             ->where('status',0)
                            ->update(['status'=>1]);
            }

            return response(['data'=>1]);
        }

    }
}
