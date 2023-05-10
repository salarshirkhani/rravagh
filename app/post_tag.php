<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_tag extends Model
{
    protected $fillable = [
        'post_id',
        'name',
    ];

    public function post() {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
