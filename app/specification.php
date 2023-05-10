<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specification extends Model
{
    protected $fillable = [
        'product_id',
        'key',
        'order',
        'value',
    ];

    public function product() {
        return $this->belongsTo('App\product');
    }
}
