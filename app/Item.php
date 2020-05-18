<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'description','category_id','quantity_type', 'shop_id','price','quantity','discount','image_url'
    ];


    public function shop()
    {
        return $this->hasMany('App\Shop', 'id', 'shop_id');

    }
    public function itemCategory()
    {
        return $this->hasOne('App\ItemCategory', 'id', 'category_id');

    }
    public function quantityType()
    {
        return $this->belongsTo('App\QuantityType', 'quantity_type_id', 'id');

    }
    public function order()
    {
        return $this->belongTo('App\Order', 'item_id', 'id');

    }
    public function getImageUrlAttribute($value)
    {
        if($value){
            return config('app.url').$value;
        }
    }
}
