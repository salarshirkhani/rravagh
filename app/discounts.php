<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discounts extends Model
{
    protected $fillable = [
        'user_id',
        'user_type',
        'brand_id',
        'discount_type',
        'code',
        'discount',
        'finish_date',
        'category',
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function brand() {
        return $this->belongsTo('App\brand','brand_id');
    }

    public function categorie() {
        return $this->belongsTo('App\Category', 'category');
    }
}
