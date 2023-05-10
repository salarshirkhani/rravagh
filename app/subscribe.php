<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscribe extends Model
{
    protected $fillable = [
        'user_id',
        'subscribe_id',
        'transaction_id',
        'status',
        'finish_date'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function subscribe() {
        return $this->belongsTo('App\subscription', 'subscribe_id');
    }
}
