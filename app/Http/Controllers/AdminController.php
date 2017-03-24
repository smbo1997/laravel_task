<?php

namespace App\Http\Controllers;

use App\Product;
use App\Producttype;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use App\Post;
use App\Updateproduct;
use Illuminate\Support\Facades\Lang;
use App\Adminchat;
use Mail;
use Image;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{

    private $data = array();
    private $language;

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
        return view('admin')->with($this->data);
    }


    public function addimage(Request $request){

        $validator= Validator::make($request->all(), [
            'storeownername' => 'required|',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:25',
            'about' => 'required|',
            'name' => 'required|',
            'fileinput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ])->validate();


        $file =$request->file('fileinput');
            $addStore=User::create(
                [
                    'name'=>$request->storeownername,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'status'=>'store',
                ]
            );
            $getStoreId = $addStore->id;
            $Folder = public_path() . 'post_images';
            if (!File::exists($Folder) && !File::isDirectory($Folder)) {
                File::makeDirectory($Folder, 0777, true);
            }
            $image=time() . '.' .$file->getClientOriginalExtension();
            $path = public_path('post_images/'.$image);
            Image::make($file)->resize(400,300)->save($path);

            Post::create([
                'user_id' => $getStoreId,
                'name' => $request->name,
                'image' => $image,
                'about' => "$request->about"
            ]);

        return redirect()->back();
    }


      public function seeshops(){
          $adminId = Auth::user()->id;
          $getshops = User::select('users.id','users.name','users.email','posts.name as posts_name','posts.image')
                               ->where('status','store')
                               ->where('store_id',NULL)
                                ->leftJoin('posts','posts.user_id','=','users.id')
                                ->get();
          $this->data['getshops']=$getshops;
        return view('seeshops')->with($this->data);
      }

      public function LoginwithUserId(Request $request,$language,$userid){
          $adminId = Auth::user()->id;
           session()->put('Admin', $adminId);
            session()->get('Admin');
          $success = Auth::loginUsingId($userid);
          if ($success){
              return redirect('/'.$language.'/user_home');
          }
      }

      public function backadmin(Request $request,$lang){
           $adminId =session()->get('Admin');
          session()->forget('Admin');
          $success = Auth::loginUsingId($adminId);
          if ($success){
              return redirect('/'.$lang.'/shops');
          }
      }

      public function Deleteshop(Request $request,$language,$userid){
          $deleteshop = User::where('id',$userid)
                ->delete();
          if ($deleteshop){
              return redirect()->back();
          }
      }

      public function seeproductswithAdmin(Request $request,$language){
          $selectshop = User::select('users.id','posts.name')
                                ->where('status','store')
                                 ->rightJoin('posts','users.id','=','posts.user_id')
                                 ->get();
                       $this->data['selectshop'] = $selectshop;
          return view('seeproductswithAdmin')->with($this->data);
      }


     public function  gettypeswithadmin(Request $request){

          $products = Producttype::select('*')
                                    ->get();
              return json_encode(['products'=>$products]);
     }

     public function  getproductsbyadmin(Request $request){
          $products = Product::select('*')
                                   ->where('type_id',$request->typeid)
                                   ->where('user_id',$request->shopid)
                                    ->get();
              return json_encode(['getproducts'=>$products]);
     }


     public  function updateproductbtadmin(Request $request, $lang,$product_id){
           $selectproduct = Product::select('*')
                                        ->where('product_id',$product_id)
                                        ->first();
            $this->data['product'] = $selectproduct;
           return view('updateproductbtadmin')->with($this->data);
     }



    public function updatedproductbyadmin(Request $request)
    {
        $file =$request->file('fileinput');
       $getupdatedproduct = Updateproduct::select('*')
                        ->where('user_id',$request->userid)
                        ->where('product_id',$request->productid)
                        ->first();
        if ($getupdatedproduct == null){
            Updateproduct::create([
                'user_id'=>$request->userid,
                'product_id'=>$request->productid,
                'status'=>1
            ]);
        }else{
           Updateproduct::where('user_id',$request->userid)
                            ->where('product_id',$request->productid)
                            ->update(['status'=>1]);
        }

        if (empty($file)) {

            $validator= Validator::make($request->all(), [
                'productname' => 'required|max:255',
                'productcontent' => 'required|max:255',
                'productprice' => 'required|numeric',
            ])->validate();
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
            $validator= Validator::make($request->all(), [
                'productname' => 'required|max:255',
                'productcontent' => 'required|max:255',
                'productprice' => 'required|numeric',
                'fileinput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ])->validate();

            $Folder = public_path() . '/products_images';
            if (!File::exists($Folder) && !File::isDirectory($Folder)) {
                File::makeDirectory($Folder, 0777, true);
            }
            $image=time() . '.' .$file->getClientOriginalExtension();
            $path = public_path('products_images/'.$image);
            Image::make($file)->resize(400,300)->save($path);
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


    public  function messages(){
         $myid = Auth::user()->id;
        $getmessages = Adminchat::select('users.name','users.email','adminchats.chat_id','adminchats.user_id','adminchats.content','adminchats.created_at')
                                    ->where('adminchats.status',0)
                                    ->where('adminchats.user_id','<>',$myid)
                                   ->leftJoin('users','users.id','=','adminchats.user_id')
                                    ->get();

        $this->data['getmessages']=$getmessages;
         return view('adminmessages')->with($this->data);
    }

    public function deletemessagebyadmin($local,$message_id){
        $delete =  Adminchat::where('chat_id',$message_id)
                                ->delete();
        if ($delete){
            return redirect()->back();
        }
    }

    public function adminseenmessage($local,$message_id){
        $update =  Adminchat::where('chat_id',$message_id)
                            ->update(['status'=>1]);
        if ($update){
            return redirect()->back();
        }
    }


    public  function  sendmessagetouser(Request $request){
        $myid = Auth::user()->id;
         Adminchat::where('chat_id',$request->chatid)
            ->update(['status'=>1]);
         Adminchat::create([
                            'user_id'=>$myid,
                            'admin_id'=>$request->userid,
                            'content'=>$request->message,
                            'status'=>0,
                        ]);
        $fromMail = Auth::user()->email;
        $to_mail = $request->email;
        $from_name = 'Store Admin';
        $subject = $request->message;
        $send = Mail::raw('Текст письма', function ($message) use($fromMail, $from_name, $to_mail, $subject) {
            $message->from($fromMail, $from_name);
            $message->to($to_mail)->subject($subject);
        });
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
        Validator::make($request->all(), [
            'typename' => 'required|max:255|nullable|alpha|unique:producttypes',
        ])->validate();
        $createtype = Producttype::create([
                'user_id'=>$userid,
                'typename'=>$request->typename
            ]);
        return redirect()->back();
    }

}
