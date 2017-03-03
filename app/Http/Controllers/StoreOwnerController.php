<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Updateproduct;
use Illuminate\Http\Request;
use App\Post;
Use App\User;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Input;
use App\Producttype;
use App\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Image;

class StoreOwnerController extends Controller
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

    public function  showblade(){
        $userId = Auth::user()->id;
        $getpost = Post::select('*')
                        ->where('user_id',$userId)
                        ->get();
        $this->data['getpost']=$getpost;
        return view('storeowner')->with($this->data);
    }

    public function updatedata(Request $request){

       $validation = Validator::make($request->all(), [
            'name' => 'required|max:16',
           'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:16'
        ])->validate();

        $userid = Auth::user()->id;
        $updateData = User::where('id',$userid)
                            ->update(
                                [
                                    'name'=>$request->name,
                                    'email'=>$request->email,
                                    'password'=>bcrypt($request->password),
                                ]
                            );

        if ($updateData){
            return redirect()->back();
        }
    }

    public  function changedata(Request $request){

        Validator::make($request->all(), [
            'name' => 'required|max:16',
            'about' => 'required|max:16',
            'fileinput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ])->validate();


        $file =$request->file('fileinput');
            $userId = Auth::user()->id;
            $Folder = public_path() . '/post_images';
            if (!File::exists($Folder) && !File::isDirectory($Folder)) {
                File::makeDirectory($Folder, 0777, true);
            }

            $image=time() . '.' .$file->getClientOriginalExtension();
            $path = public_path('post_images/'.$image);
            Image::make($file)->resize(400,300)->save($path);
            Post::where('user_id', $userId)
                ->update([
                    'name' => $request->name,
                    'image' => $image,
                    'about' => $request->about
                ]);
            return redirect()->back();
    }


    public  function addtypes(Request $request){
        $userid = Auth::user()->id;
        $selectTypes = Producttype::select('*')
                                    ->where('user_id',$userid)
                                    ->get();
        $this->data['selectTypes']=$selectTypes;
        return view('addtypes')->with($this->data);
    }


    public function addnewtype(Request $request){
        $userid = Auth::user()->id;
        $createtype = Producttype::create(
            [
                'user_id'=>$userid,
                'typename'=>$request->addtype
            ]
        );
        return redirect()->back();
    }

    public function deletetype(Request $request,$locale,$type_id){
      Producttype::where('type_id',$type_id)
                        ->delete();
        return redirect()->back();
    }

    public function products(){
        $userId = Auth::user()->id;
        $getproductsTypes = Producttype::select('*')
                                         ->where('user_id',$userId)
                                         ->get();
        $this->data['getproductsTypes']=$getproductsTypes;
        return view('storeproduct')->with($this->data);
    }

    public  function addnewproduct(Request $request){

        Validator::make($request->all(), [
            'productname' => 'required|max:16',
            'productcontent' => 'required|max:16',
            'productprice' => 'required|numeric|max:255',
            'fileinput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ])->validate();


        $file =$request->file('fileinput');
        $userId = Auth::user()->id;
        $Folder = public_path() . '/post_images';
        if (!File::exists($Folder) && !File::isDirectory($Folder)) {
            File::makeDirectory($Folder, 0777, true);
        }

        $image=time() . '.' .$file->getClientOriginalExtension();
        $path = public_path('post_images/'.$image);
        Image::make($file)->resize(400,300)->save($path);

            $userId = Auth::user()->id;
            $Folder = public_path() . '/products_images';
            $image=time() . '.' .$file->getClientOriginalExtension();
            if (!File::exists($Folder) && !File::isDirectory($Folder)) {
                File::makeDirectory($Folder, 0777, true);
            }
            $file->move($Folder,$image);
            Product::create([
                'type_id'=>$request->producttype,
                'user_id'=>$userId,
                'product_name'=>$request->productname,
                'product_content'=>$request->productcontent,
                'product_price'=>$request->productprice,
                'product_image'=>$image
                ]);

        return redirect()->back();
    }


    public function seeproducts(){
        $userId = Auth::user()->id;
        $getproductsTypes = Producttype::select('*')
            ->where('user_id',$userId)
            ->get();
        $productid = Producttype::select('*')
            ->where('user_id',$userId)
            ->first();
        if ($productid !== null){
            $selectproducts = Product::select('*')
                ->where('type_id',$productid->type_id)
                ->get();
        }
        else{
            $selectproducts = array();
        }
        $this->data['selectproducts']=$selectproducts;
        $this->data['getproductsTypes']=$getproductsTypes;
        return view('seeproducts')->with($this->data);
    }

    public function selectproducts(Request $request){
        $productid = $request->productid;
        $selectproducts = Product::select('*')
                                    ->where('type_id',$productid)
                                    ->get();

         return json_encode(['selectproducts'=>$selectproducts]);
    }


    public function deleteproduct(Request $request,$locale,$product_id){
        Product::where('product_id',$product_id)
                 ->delete();
        return redirect()->back();

    }


    public  function updatedproductbyadmin(){
        $userid = Auth::user()->id;
        $selectupdatedproducts =Updateproduct::select('updatedproducts.update_id','products.user_id','products.product_name','products.product_content','products.product_price','products.product_image')
                                                ->where('updatedproducts.user_id',$userid)
                                                ->where('updatedproducts.status',1)
                                                ->rightJoin('products','updatedproducts.product_id','=','products.product_id')
                                                ->get();

        $this->data['selectupdatedproducts'] = $selectupdatedproducts;
        return view('updatedproductbyadmin')->with($this->data);

    }

    public  function  seenupdate(Request $request){
       $update =  Updateproduct::where('update_id',$request->updateid)
                        ->update(['status'=>0]);
        if ($update){
            return response(['true'=>'true']);
        }
    }

    public function mynotification(Request $request){
        $userid = Auth::user()->id;
            $updatecount = Updateproduct::select('*')
                                            ->where('user_id',$userid)
                                            ->where('status',1)
                                            ->get();
        $setcount = count($updatecount);

        return response(['setcount'=>$setcount]);
    }


    public function makestoreworkers(){
        $userid = Auth::user()->id;
        $storeworkers = User::select('*')
                                ->where('store_id',$userid)
                                ->get();
        $this->data['storeworkers']=$storeworkers;
        return view('makestoreworkers')->with($this->data);
    }

    public function addstoreworkers(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:16',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:16',
        ])->validate();

        $storeowner_id = Auth::user()->id;
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'status'=>'store',
            'store_id'=>$storeowner_id,
        ]);

        return redirect()->back();
    }

    public  function  deleteworker(Request $request,$lang,$worker_id){
             User::where('id',$worker_id)
                    ->delete();
        return redirect()->back();
    }

    public function bouthproducts(Request $request,$lang){
        $userid = Auth::user()->id;
           $get = Product::select('users.name','products.product_price','products.product_image','baskets.count','baskets.created_at')
                       ->where('products.user_id',$userid)
                        ->rightJoin('baskets','products.product_id','=','baskets.product_id')
                        ->where('baskets.status',1)
                        ->leftJoin('users','users.id','=','baskets.user_id')
                        ->get();
            $this->data['bouthproducts']=$get;
        return view('bouthproducts')->with($this->data);
    }


    public function showStorechat(){
        $storeid = Auth::user()->id;
        $getusers = Chat::distinct()
                            ->select('chats.from_id','users.name','users.email')
                            ->where('to_id', '=', $storeid)
                            ->leftJoin('users','users.id','=','chats.from_id')
                            ->get();
        $this->data['getusers'] =$getusers;
        return view('StoreChat')->with($this->data);
    }


    public function getproductsByprice(Request $request){
        $selectproducts = Product::select('*')
                                    ->where('type_id',$request->product_type)
                                    ->where('product_price','>=',$request->minprice)
                                    ->where('product_price','<=',$request->maxprice)
                                    ->get();

        return json_encode(['productByPrice'=>$selectproducts]);
    }
}
