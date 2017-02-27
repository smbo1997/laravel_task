<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankcard extends Model
{
    protected  $table='creditcards';
    protected $fillable=[
        'user_id','card_no','exp_month','cvc'
    ];

}
