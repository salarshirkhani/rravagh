<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    protected $table='movies';
    protected $fillable=['title','description','slug','year', 'status' , 'link', 'trailer', 'duaration',  'image', 'category', ];

    public function tags() {
        return $this->hasMany('App\movie_tag');
    }

    public function post() {
        return $this->belongsTo('App\Category', 'category');
    }
    
    public function comment() {
        return $this->hasMany('App\comment', 'movie_id');
    }
    
    public function categorie() {
        return $this->belongsTo('App\Category', 'category');
    }
}
