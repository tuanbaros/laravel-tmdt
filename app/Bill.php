<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function carts(){
        return $this->belongsTo('App\Cart', 'cart_id');
    }

    public function orders(){
        return $this->hasOne('App\Order');
    }
}
