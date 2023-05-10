<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
        'title',
        'explain',
        'content',
        'role',
        'pic',
        'statuss'
    ];
}
