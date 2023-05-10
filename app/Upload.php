<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table='uploads';
    
    protected $fillable = [
        'product_id','link',
    ];

    public function product() {
        return $this->belongsTo('App\product', 'product_id');
    }

}
