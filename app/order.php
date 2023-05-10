<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'transaction_id', 'status', 'amount', 'color', 'number'
    ];
 
    public function transaction() {
        return $this->belongsTo('App\transaction', 'transaction_id');
    }

    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function for() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
