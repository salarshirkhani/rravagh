<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'movie_id',
        'product_id',
        'name',
        'email',
        'description',
    ];

    public function for() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function post() {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    
    public function movie() {
        return $this->belongsTo('App\movies', 'movie_id');
    }

    public function answer() {
        return $this->belongsTo('App\comment', 'answer_id');
    }
}
