<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    protected $fillable = [
        'title',
        'image',
        'priority',
        'url',
        'place',
    ];

    protected $table = 'slider_items';
}
