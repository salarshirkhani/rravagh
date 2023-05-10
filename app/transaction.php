<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'transaction', 'status', 'amount', 'invoice_code','city', 'county','address','phone','postcode','discount'
    ];

    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function orders() {
        return $this->hasOne('App\order', 'product_id');
    }
}
