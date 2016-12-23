<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // public function books()
    // {
    //     return $this->belongsToMany('App\Book', 'cart_books', 'cart_id', 'book_id');
    // }

    // public function cartBooks()
    // {
    //     return $this->hasMany('App\CartBook');
    // }
    
    public function cartBooks(){
        return $this->hasMany('App\CartBook');
    }
}
