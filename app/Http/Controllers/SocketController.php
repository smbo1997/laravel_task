<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Bankcard;

class SocketController extends Controller
{
    public  function index(Artisan $artisan)
    {
       $artisan::call('chatserver:go');
//        Bankcard::where('card_id',2)
//                   ->where('user_id',4)
//                    ->delete();
    }


}
