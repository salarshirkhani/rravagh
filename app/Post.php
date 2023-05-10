<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'explain',
        'slug',
        'content',
        'writer',
        'pic',
        'file',
        'iframe',
    ];

    protected $cascadeDeletes = ['tags'];


    public function tags() {
        return $this->hasMany('App\post_tag');
    }
    
    public function comment() {
        return $this->hasMany('App\comment', 'post_id');
    }
    
    public function categorie() {
        return $this->belongsTo('App\Category', 'category');
    }
}