<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
   protected $fillable = [
        'name',
    ];

    protected $cascadeDeletes = ['color'];

    public function color() {
        return $this->hasMany('App\product_color', 'color_id');
    }
}
