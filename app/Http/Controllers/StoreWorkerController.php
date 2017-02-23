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

class StoreWorkerController extends Controller
{
    private  $data = array();
    private  $language;
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $language = $request->segment(1);
        $this->language = $language;
        $this->data['language']=$language;
    }

    public function showstoreworker(){
        $userId = Auth::user()->store_id;
        $getproductsTypes = Producttype::select('*')
                                        ->where('user_id',$userId)
                                        ->get();
        $this->data['getproductsTypes']=$getproductsTypes;
        return view('storeworkers')->with($this->data);
    }


    public function addnewproductwithworkers(Request $request){
        $file =$request->file('fileinput');
        if (empty($file)) {

            return redirect()->back();
        }
        else{
            $userId = Auth::user()->store_id;
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
        }
        return redirect()->back();
    }


    public function seeproductwithworkers(){
        $userId = Auth::user()->store_id;
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
        return view('seeproductswithworkers')->with($this->data);
    }


    public function deleteproductwithworker(Request $request,$lang,$product_id){
        Product::where('product_id',$product_id)
                ->delete();
        return redirect()->back();
    }

    public function selectproductswithworkers(Request $request){
        $productid = $request->productid;
        $selectproducts = Product::select('*')
            ->where('type_id',$productid)
            ->get();

        return json_encode(['selectproducts'=>$selectproducts]);
    }

    public function  updateproductwithworker(Request $request, $lang,$product_id){
        $selectproduct = Product::select('*')
            ->where('product_id',$product_id)
            ->first();
        $this->data['product'] = $selectproduct;
        return view('updateproductwithworker')->with($this->data);
    }



    public function updatedproductwithworkers(Request $request){
        $file =$request->file('fileinput');

        if (empty($file)) {
            $update = Product::where('product_id',$request->productid)
                ->update([
                    'product_name'=>$request->productname,
                    'product_content'=>$request->productcontent,
                    'product_price'=>$request->productprice
                ]);
            if ($update){
                return redirect()->back();
            }
        }
        else{
            $Folder = public_path() . '/products_images';
            $image=time() . '.' .$file->getClientOriginalExtension();
            if (!File::exists($Folder) && !File::isDirectory($Folder)) {
                File::makeDirectory($Folder, 0777, true);
            }
            $file->move($Folder,$image);
            $updated = Product::where('product_id',$request->productid)
                ->update([
                    'product_name'=>$request->productname,
                    'product_content'=>$request->productcontent,
                    'product_price'=>$request->productprice,
                    'product_image'=>$image
                ]);
            if ($updated){
                return redirect()->back();
            }
        }
    }
}
