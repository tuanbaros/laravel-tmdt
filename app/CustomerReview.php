<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
      'book_id', 'user_id', 'content',
    ];
}
