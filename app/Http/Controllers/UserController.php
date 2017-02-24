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
use App\Bankcard;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Mail;

class UserController extends Controller
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
    public function showcharts(Request $request){
        $userId = Auth::user()->id;
        $gotproducts = Basket::select('*')
                                ->where('baskets.user_id',$userId)
                                ->where('baskets.status',0)
                                ->leftJoin('products','products.product_id','=','baskets.product_id')
                                ->get();

           $this->data['gotproducts']=$gotproducts;
        return view('mycharts')->with($this->data);
    }


    public function buyproduct(Request $request){
        $userid = Auth::user()->id;
        if($userid){
            $getbasketsbyuserid = Basket::select('*')
                     ->where('user_id',$userid)
                     ->where('product_id',$request->productId)
                     ->where('status',0)
                    ->first();
            if($getbasketsbyuserid == null){
                Basket::create([
                    'user_id'=>$userid,
                    'product_id'=>$request->productId,
                    'count'=>$request->count,
                    'status'=>0
                ]);
            }
            else{
                Basket::where('user_id',$userid)
                    ->where('product_id',$request->productId)
                    ->where('status',0)
                    ->update(['count'=>$getbasketsbyuserid->count+$request->count]);
            }
        }

    }


    public function getbasketsdata(Request $request){
        $userId = Auth::user()->id;
        $myarray = array();
         $get = Basket::select('*')
                ->where('user_id',$userId)
                ->where('status',0)
                ->get();

         if(!empty($get)){
             foreach($get as $key=>$value){
                 array_push($myarray,"$value->count");
             }
             $getcount = array_sum($myarray);
         }

         return response(['basketcount'=>$getcount]);
    }

    public function deletebasket($lang,$basketId){
        $userId = Auth::user()->id;
        $delete = Basket::where('basket_id',$basketId)
                            ->delete();
        if($delete){
            return redirect()->back();
        }
    }

    public function buymyproduct(Request $request){
        $useremail = Auth::user()->email;
        Mail::send('emails.send', ['subject'=>'Thank you for shops'],function ($message) use($useremail)
        {
            $message->from('smbtest97@gmail.com', 'Message');
            $message->to($useremail);

        });

        $buy =  Basket::where('basket_id',$request->basketid)
                            ->update(['status'=>1]);

        if ($buy){
            return response(['data'=>1]);
        }
    }

    public function buyall(Request $request){
        $data = $request->data;
        if(!empty($data)){
            $useremail = Auth::user()->email;
            Mail::send('emails.send', ['subject'=>'Thank you for shops'],function ($message) use($useremail)
            {
                $message->from('smbtest97@gmail.com', 'Message');
                $message->to($useremail);

            });

            foreach ($data as $key=>$value){
                Basket::where('basket_id',$value)
                    ->where('status',0)
                    ->update(['status'=>1]);
            }

            return response(['data'=>1]);
        }

    }

    public  function mycard(Request $request){

        return view('mycard')->with($this->data);
    }

    public function addcard(Request $request){

       Validator::make($request->all(), [
            'cardno' => 'required|min:16|max:16',
            'expmonth' => 'required|min:2|max:2',
            'expyear' => 'required|min:4|max:4',
            'cvc' => 'required|min:3|max:4'
        ])->validate();

        $userId = Auth::user()->id;
        $getcard = Bankcard::select('*')
                               ->where('user_id',$userId)
                                ->first();
        if ($getcard == null){
            $create =  Bankcard::create([
                'user_id' => $userId,
                'card_no' => $request->cardno,
                'exp_month' =>  $request->expmonth,
                'exp_year' =>  $request->expyear,
                'cvc' =>  $request->cvc
            ]);
        }
       else{
            Bankcard::where('user_id',$userId)
                        ->update([
                            'card_no' => $request->cardno,
                            'exp_month' =>  $request->expmonth,
                            'exp_year' =>  $request->expyear,
                            'cvc' =>  $request->cvc
                        ]);
          }

           return redirect()->back();
    }
}
