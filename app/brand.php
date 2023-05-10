<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{

    protected $table='brands';
    protected $fillable = [
        'name',
        'url',
        'image',
    ];

    public function discount() {
        return $this->hasOne('App\discounts', 'brand_id');
    }

    public function brand() {
        return $this->hasMany('App\Product', 'brand');
    }

    public function academy() {
        return $this->hasMany('App\academy', 'brand_id');
    }
}
