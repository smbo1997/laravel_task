<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Updateproduct extends Model
{
    protected $table = "updatedproducts";
    protected $fillable = [
        'user_id', 'product_id', 'status'
    ];


}
