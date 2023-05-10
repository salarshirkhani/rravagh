<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_tag extends Model
{
    protected $fillable = [
        'product_id',
        'name',
    ];

    

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
