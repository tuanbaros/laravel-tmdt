<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    public function search($key, Request $request)
    {
        $skip = $request->query('skip');
        return DB::table('books')
            ->where('books.title', 'like', '%'.$key.'%')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy('id')
            ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author')
            ->skip($skip)->take(10)->get()->toJson();
    }
}
