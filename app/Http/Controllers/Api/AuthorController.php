<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Book;

class AuthorController extends Controller
{
    public function show($id, Request $request)
    {
        $skip = $request->query('skip');
        $book = DB::table('books')
            ->where('books.id', $id)
            ->select('books.author_id')
            ->first();
        $authorId = $book->author_id;
        $author = DB::table('authors')
            ->where('authors.id', $authorId)
            ->select('authors.id', 'authors.name', 'authors.introduce', 'authors.contact', 'authors.avatar')
            ->first();
                 
        $books = Book::getBookOfAuthor($authorId);
        $rate = 0;
        foreach ($books->get() as $key => $b) {
            $rate += $b->rateAverage; 
        }
        $author->rateBookAverage = $rate/count($books);

        $totals = DB::table('books')
            ->where('books.author_id', $authorId)
            ->select('books.quantity_selling')
            ->get();

        $total = 0;
        foreach ($totals as $key => $t) {
            $total += $t->quantity_selling;
        }
        $author->TotalSold = $total;
        $author->listBooks = $books->skip($skip)->take(10)->get();
        return json_encode($author);
    }
}
