<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    protected $fillable = [
        'user_id', 'product_id','status'
    ];
 
    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function for() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
