<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class page extends Model
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
        'category'
    ];

    protected $cascadeDeletes = ['tags'];


    public function tags() {
        return $this->hasMany('App\page_tag');
    }
    
    
    public function categorie() {
        return $this->belongsTo('App\Category', 'category');
    }
}