<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cartBooks(){
        return $this->hasMany('App\CartBook');
    }

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }
}
