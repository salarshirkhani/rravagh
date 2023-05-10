<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class promote extends Model
{  
    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'file',
    ];

    

    public function for() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
