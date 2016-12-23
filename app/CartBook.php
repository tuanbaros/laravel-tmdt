<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartBook extends Model
{
    public function books(){
        return $this->belongsTo('App\Book', 'book_id');
    }

    public function carts(){
        return $this->belongsTo('App\Cart', 'cart_id');
    }
}
