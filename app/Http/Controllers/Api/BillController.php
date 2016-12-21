<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class BillController extends Controller
{
    public function show($id)
    {
        $bills = DB::table('bills')
            ->where('bills.user_id', $id)
            ->select('bills.id', 'bills.status', 'bills.created_at as time', 'bills.cart_id')
            ->get();

        foreach ($bills as $key => $bill) {
            $cartbooks = DB::table('cart_books')
                ->where('cart_books.cart_id', $bill->cart_id)
                ->join('books', 'cart_books.book_id', '=', 'books.id')
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->select('cart_books.id', 'cart_books.book_id as idBook', 'books.title', 'authors.name as author', 'books.image_url as images', 'books.price as old_price', 'books.new_price as price', 'cart_books.quantity', 'cart_books.created_at as time')
                ->orderBy('cart_books.created_at')
                ->get();
            $bill->listbooks = $cartbooks;
        }

        return json_encode($bills);
    }
}
