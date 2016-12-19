<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StatusController extends Controller
{
    public function show($id)
    {
        switch ($id) {
            case 'new-releases':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('books.date_releases', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price', 'authors.name as author')
                    ->take(10)->get()->toJson();
                break;
            case 'top-selling':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price', 'authors.name as author')
                    ->take(10)->get()->toJson();
                break;
            case 'top-saleoff':
                return DB::table('books')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('books.discount_percent', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price', 'authors.name as author')
                    ->take(10)->get()->toJson();
                break;
            default:
                # code...
                break;
        }
    }
}
