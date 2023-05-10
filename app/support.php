<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class support extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'transaction', 'status', 'amount'
    ];

    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function product() {
        return $this->hasOne('App\Product', 'product_id');
    }
}
