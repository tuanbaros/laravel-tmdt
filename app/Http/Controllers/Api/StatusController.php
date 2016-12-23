<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StatusController extends Controller
{
    public function show($id, Request $request)
    {
        $skip = $request->query('skip');
        switch ($id) {
            case 'new-releases':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('books.date_releases', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author', 'books.date_releases')
                    ->skip($skip)->take(10)->get()->toJson();
                break;
            case 'top-selling':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('books.quantity_selling', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author', 'books.quantity_selling')
                    ->skip($skip)->take(10)->get()->toJson();
                break;
            case 'top-saleoff':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('books.discount_percent', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author', 'books.discount_percent')
                    ->skip($skip)->take(10)->get()->toJson();
                break;
            default:
                # code...
                break;
        }
    }
}
