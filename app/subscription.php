<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'status',
        'time',
    ];

    public function subscribe() {
        return $this->hasMany('App\subscribe', 'subscribe_id');
    }
}
