<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chats';
    protected  $fillable = ['from_id','to_id','content','status'];


    public  function messages(){
        return $this->belongsTo('App\User','to_id');
    }
}
