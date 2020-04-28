<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name','contact_no','address'
    ];

    public function item()
    {
        return $this->belongsToMany('App\Item', 'id', 'shop_id');

    }
}
