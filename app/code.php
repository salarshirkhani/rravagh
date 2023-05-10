<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class code extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'status',
    ];

    

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
