<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie_tag extends Model
{
    protected $fillable = [
        'movie_id',
        'name',
    ];

    public function post() {
        return $this->belongsTo('App\movies', 'movie_id');
    }
}
