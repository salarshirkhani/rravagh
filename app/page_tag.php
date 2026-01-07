<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class page_tag extends Model
{
    protected $fillable = [
        'post_id',
        'name',
    ];

    public function post() {
        return $this->belongsTo('App\page', 'post_id');
    }
}
