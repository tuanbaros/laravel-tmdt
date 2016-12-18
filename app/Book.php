<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function customerReviews(){
        return $this->hasMany('App\CustomerReview');
    }
}
