<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AuthorController extends Controller
{
    public function show($id)
    {
        $book = DB::table('books')
            ->where('books.id', $id)
            ->select('books.author_id')
            ->first();
        $authorId = $book->author_id;
        $author = DB::table('authors')
            ->where('authors.id', $authorId)
            ->select('authors.id', 'authors.name', 'authors.introduce', 'authors.contact', 'authors.avatar')
            ->first();

        $books = DB::table('books')
            ->where('books.author_id', $authorId)
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->select('books.id as idBook', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author')
            ->get();
        $rate = 0;
        foreach ($books as $key => $b) {
            $rate += $b->rateAverage; 
        }
        $author->rateBookAverage = $rate/count($books);

        $totals = DB::table('books')
            ->where('books.author_id', $authorId)
            ->select('books.quantity_selling', 'books.quantity_remain')
            ->get();

        $total = 0;
        foreach ($totals as $key => $t) {
            $total += ($t->quantity_remain - $t->quantity_selling);
        }
        $author->TotalSold = $total;
        $author->listBooks = $books;
        return json_encode($author);
    }
}
