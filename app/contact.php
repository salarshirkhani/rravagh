<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = [
        'user_id', 'name', 'number', 'status', 'email', 'job'
    ];
 
    public function person() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
