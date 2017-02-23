<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'name', 'image','about'
    ];

    public function userdata(){
        return $this->belongsTo('App\User');
    }
}
