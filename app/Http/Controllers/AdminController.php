<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // account manager
    public function getListAccount(){
        $accounts = User::all();
        return view('admin.ListAccount', compact('accounts'));
    }

    // book manager
    public function getListProduct(){
        $books = Book::all();
        return view('admin.ListProduct', compact('books'));
    }
}
