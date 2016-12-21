<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class BookController extends Controller
{
    public function show($book_id, $user_id = 0)
    {
        $book = DB::table('books')
            ->where('books.id', $book_id)
            ->select('books.*', 'books.price as old_price', 'books.new_price as price')
            ->first();

        $author = DB::table('authors')
            ->where('authors.id', $book->author_id)
            ->select('authors.id', 'authors.name', 'authors.introduce', 'authors.avatar')
            ->first();

        $books = DB::table('books')
            ->where('books.author_id', $book->author_id)
            ->get();
        $rate = 0;
        $total = 0;
        foreach ($books as $key => $b) {
            $rate += $b->rate_average; 
            $total += $b->quantity_selling;
        }
        $author->rateBookAverage = $rate/count($books);
        $author->TotalSold = $total;
        
        $book->author = $author;
        $book->quantityBuy = $book->quantity_selling;

        if ($user_id > 0) {
            $rate = DB::table('rates')
                ->where('rates.book_id', $book->id)
                ->where('rates.user_id', $user_id)
                ->get();
            if (count($rate) > 0) {
                 $book->userRate = $rate[0]->point;
            } else {
                $book->userRate = 0;
            } 
        } else {
            $book->userRate = 0;
        }

        if ($book->quantity_remain > 0) {
            $book->status = 'Con hang';
        } else {
            $book->status = 'Het hang';
        }

        $rates = DB::table('rates')
            ->where('rates.book_id', $book->id)
            ->get();

        $book->quantityRating = count($rates);

        return json_encode($book);
    }
}
