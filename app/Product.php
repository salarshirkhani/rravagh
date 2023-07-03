<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
        'name',
        'explain',
        'content',
        'price',
		'pic',
		'category',
        'brand',
        'lovely',
        'discount',
        'cheap',
        'helpprice',
        'discountable',
    ];

    protected $cascadeDeletes = ['color', 'comment', 'specifications', 'image', 'hasMany'];

    public function color() {
        return $this->hasMany('App\product_color');
    }

    public function tags() {
        return $this->hasMany('App\product_tag');
    }

    public function comment() {
        return $this->hasMany('App\comment', 'product_id');
    }

    public function brands() {
        return $this->belongsTo('App\brand','brand');
    }

    public function categorie() {
        return $this->belongsTo('App\Category', 'category');
    }

    public function specifications() {
        return $this->hasMany('App\specification');
    }

    public function image() {
        return $this->hasMany('App\Upload', 'product_id');
    }

    public function likes() {
        return $this->hasMany('App\likes', 'product_id');
    }
}
