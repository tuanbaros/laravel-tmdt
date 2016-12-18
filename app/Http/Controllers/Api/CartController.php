<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Cart;

class CartController extends Controller
{
    public function show($id)
    {
        $cart =  Cart::where('carts.user_id', $id)
            ->select('carts.id', 'carts.total_cost')->first();
        $cartbooks = DB::table('cart_books')
            ->where('cart_books.cart_id', $cart->id)
            ->join('books', 'cart_books.book_id', '=', 'books.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->select('cart_books.id', 'cart_books.book_id as idBook', 'books.title', 'authors.name as author', 'books.image_url as images', 'books.price', 'books.new_price', 'cart_books.quantity', 'cart_books.created_at as time')
            ->orderBy('cart_books.created_at')
            ->get();
        $cart->cartbooks = $cartbooks;
        return json_encode($cart);
    }
}
