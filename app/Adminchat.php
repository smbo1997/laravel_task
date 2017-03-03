<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adminchat extends Model
{
    protected  $fillable =['user_id','admin_id','content','status'];
}
