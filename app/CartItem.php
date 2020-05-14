<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function order(){

        return $this->belongsTo('App\Order','order_id','id');
    }

    public function item(){

        return $this->belongsTo('App\Item','item_id','id');
    }


}
