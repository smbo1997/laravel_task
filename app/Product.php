<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable=[
            'type_id','user_id','product_name','product_content','product_price','product_image'
    ];
}
