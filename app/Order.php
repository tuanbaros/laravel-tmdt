<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cartBooks(){
        return $this->hasMany('App\CartBook');
    }
}
