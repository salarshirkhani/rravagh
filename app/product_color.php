<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_color extends Model
{
    protected $fillable = [
        'color_id',
        'product_id',
    ];
   
    public function color() {
        return $this->belongsTo('App\color','color_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
