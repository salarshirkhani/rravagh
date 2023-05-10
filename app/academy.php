<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class academy extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
    ];
   
    public function brands() {
        return $this->belongsTo('App\brand','brand_id');
    }

    public function teacher() {
        return $this->belongsTo('App\teacher', 'user_id');
    }
}
