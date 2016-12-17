<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('categories')
            ->join('images', 'categories.image_id', '=', 'images.id')
            ->select('categories.id', 'categories.name', 'images.url')
            ->get()->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = DB::table('books')
            ->where('books.category_id', '=', $id)
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->orderBy('id')
            ->select('books.*', 'categories.name as category', 'authors.name as author')
            ->get();
        foreach ($books as $key => $book) {
            $book->images = DB::table('images')
                ->where('images.book_id', '=', $book->id)->get();
            $author = DB::table('authors')
                ->where('authors.id', '=', $book->author_id)->first();
            $bs = DB::table('books')->where('books.author_id', $author->id)->get();
            $count = 0;
            foreach ($bs as $key => $b) {
                $count += ($b->quantity_remain - $b->quantity_selling);
            }
            $author->total_sold = $count;
            $book->author = $author;
        }

        return json_encode($books);
    }
}
