<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuantityType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function item()
    {
        return $this->belongsToMany('App\Item', 'id', 'quantity_type_id');

    }
}
