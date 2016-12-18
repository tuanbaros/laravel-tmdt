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
                    ->orderBy('books.date_releases', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price')
                    ->take(10)->get()->toJson();
                break;
            case 'top-selling':
                return DB::table('books')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price')
                    ->take(10)->get()->toJson();
                break;
            case 'top-saleoff':
                return DB::table('books')
                    ->orderBy('books.discount_percent', 'DESC')
                    ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price')
                    ->take(10)->get()->toJson();
                break;
            default:
                # code...
                break;
        }
    }
}
