<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'avatar', 'id_fb', 'fb_token', 'token'
    ];

    public function customerReviews(){
        return $this->hasMany('App\CustomerReview');
    }
    
    public function carts(){
        return $this->hasOne('App\Cart');
    }

    public function rates(){
        return $this->hasMany('App\Rate');
    }

    public function bills(){
        return $this->hasMany('App\Bill');
    }

}
