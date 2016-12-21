<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RateController extends Controller
{
    public function show($id, Request $request)
    {
        $skip = $request->query('skip');
        $books = DB::table('books')
            ->where('books.id', $id)
            ->select('books.id')
            ->first();
        $books->rate5star = 0;
        $books->rate4star = 0;
        $books->rate3star = 0;
        $books->rate2star = 0;
        $books->rate1star = 0;


        $rates = DB::table('rates')
            ->where('rates.book_id', $id)
            ->join('users', 'users.id', '=', 'rates.user_id')
            ->select('rates.*', 'rates.point as rate', 'users.name as usernameRating', 'users.avatar as urlAvatar', 'rates.created_at as time')
            ->get();

        foreach ($rates as $key => $rate) {
            switch ($rate->point) {
                case 1:
                    $books->rate1star++;
                    break;
                case 2:
                    $books->rate2star++;
                    break;
                case 3:
                    $books->rate3star++;
                    break;
                case 4:
                    $books->rate4star++;
                    break;
                case 5:
                    $books->rate5star++;
                    break;
                default:
                    # code...
                    break;
            }
            
        }
        
        $reviews = DB::table('customer_reviews')
                ->where('customer_reviews.book_id', $id)
                ->join('users', 'users.id', '=', 'customer_reviews.user_id')
                ->select('customer_reviews.*', 'customer_reviews.created_at as time', 'users.name as usernameRating', 'users.avatar as urlAvatar')
                ->skip($skip)->take(10)->get();

        foreach ($reviews as $key => $review) {
            $rate = DB::table('rates')
                ->where('rates.book_id', $review->book_id)
                ->where('rates.user_id', $review->user_id)
                ->select('rates.point')->first();
            $review->rate = $rate->point;
        }

        $books->listReviews = $reviews;

        return json_encode($books);
    }
}
