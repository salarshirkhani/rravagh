<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = [
        'user_id', 'level', 'instagram', 'description'
    ];

    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function teacher() {
        return $this->hasMany('App\academy', 'user_id');
    }
}
