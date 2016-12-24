<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function customerReviews(){
        return $this->hasMany('App\CustomerReview');
    }
    public function scopeGetBookOfAuthor($query, $authorId)
    {
        return $query->where('books.author_id', $authorId)
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->select('books.id as idBook', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author'); 
    }

    public function cartBooks(){
        return $this->hasMany('App\CartBook');
    }
    
    public function images(){
        return $this->hasMany('App\Image');
    }
}
