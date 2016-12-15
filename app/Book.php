<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function images(){
        return $this->hasMany('App\Image');
    }

    public function customerReviews(){
        return $this->hasMany('App\CustomerReview');
    }
}
