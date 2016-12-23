<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'address', 'phone', 'avatar', 'id_fb', 'fb_token', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
