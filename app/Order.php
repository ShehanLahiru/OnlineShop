<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function user(){

        return $this->belongsTo('App\User','user_id','id');
    }
    public function shop(){

        return $this->belongsTo('App\User','shop_id','id');
    }

    public function item(){

        return $this->belongsTo('App\User','item_id','id');
    }
    public function cart(){

        return $this->hasMany('App\CartItem','order_id','id');
    }
}
