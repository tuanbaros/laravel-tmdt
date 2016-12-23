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
            ->select('categories.id', 'categories.name', 'categories.image_url as urlImage')
            ->get()->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $skip = $request->query('skip');
        return DB::table('books')
            ->where('books.category_id', '=', $id)
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy('id')
            ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author')
            ->skip($skip)->take(10)->get()->toJson();
    }
}
