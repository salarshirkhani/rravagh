<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class support extends Model
{
    protected $table='support';

    protected $fillable = [
        'user_id', 'product_id', 'transaction', 'status', 'amount','transaction_id',
    ];

    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function product() {
        return $this->hasOne('App\Product', 'product_id');
    }
}
