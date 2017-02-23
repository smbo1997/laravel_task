<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class LoginPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

//    public  function is_user(User $user){
//        if(!empty($user)){
//            if($user->status == 'user')
//            {
//                return true;
//            }
//           return false;
//        }
//    }

    public  function is_admin(User $user){
        if(!empty($user)){
            if($user->status == 'admin')
            {
                return true;
            }
            return false;
        }
    }

    public  function is_store(User $user){
        if(!empty($user)){
            if($user->status == 'store')
            {
                return true;
            }
            return false;
        }
    }

    public  function is_user(User $user){
        if(!empty($user)){
            if($user->status == 'user')
            {
                return true;
            }
            return false;
        }
    }
}
