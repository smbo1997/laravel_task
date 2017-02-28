<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chats';
    protected  $fillable = ['from_id','to_id','content','status'];
}
