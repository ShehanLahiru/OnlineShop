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
        return $this->hasMany('App\Shop', 'shop_id', 'id');

    }
    public function itemCategory()
    {
        return $this->has('App\ItemCategory', 'category_id', 'id');

    }
    public function quantityType()
    {
        return $this->has('App\QuantityType', 'quantity_type_id', 'id');

    }
    public function getImageUrlAttribute($value)
    {
        if($value){
            return config('app.url').$value;
        }
    }
}
