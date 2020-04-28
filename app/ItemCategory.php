<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = [
        'name',
    ];
    public function item()
    {
        return $this->belongsToMany('App\Item', 'id', 'category_id');

    }
}
