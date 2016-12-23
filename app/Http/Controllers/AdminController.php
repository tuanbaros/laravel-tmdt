<?php

namespace App\Http\Controllers;

use App\Author;
use App\Bill;
use App\Book;
use App\Cart;
use App\CartBook;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    /*
     *  account manager 
     * */
    public function getListAccount(){
        $accounts = User::all();
        return view('admin.ListAccount', compact('accounts'));
    }
    /* delete account */
    public function deleteAccount($id){
        $user = User::findOrFail($id);
        // delete cart
        $cart = $user->carts;
        if ($cart!=null){
            $cart->delete();
        }
        // delete customer reviews
        $customer_reviews = $user->customerReviews;
        if ($customer_reviews!=null){
            foreach ($customer_reviews as $review)
                $review->delete();
        }
        // delete rates
        $rates = $user->rates;
        if ($rates!=null){
            foreach ($rates as $rate)
                $rate->delete();

        }
        // delete bills
        $bills = $user->bills;
        if ($bills!=null){
            foreach ($bills as $bill)
                $bill->delete();
        }
        // delete user
        $user->delete();

        return redirect('account.manager');
    }
    
    /* display list bill for each account */
    public function listBillForEachAccount($id){
        $bills = User::find($id)->bills;
        $user_id = $id;
        return view('admin.ListBillForEachAccount', compact('bills', 'user_id'));
    }

    /* display cart */
    public function cart($id){
        $cart = User::find($id)->carts;
        if ($cart!=null){
            $cart_books = $cart->cartBooks;
            $total_cost = $cart->total_cost;

            return view('admin.Cart',compact('total_cost', 'cart_books'));
        }else{
            echo "User chưa có giỏ hàng!";
        }

    }

    /* delete cart item */
    public function deleteCartItem($id){
        $cart_book = CartBook::find($id);
        $user_id = $cart_book->carts->user_id;
        // delete item in cart
        $cart_book->delete();
        $route = "account.cart-$user_id";
        return redirect($route);
    }

    /*
     *  book manager
     * */
    public function getListProduct(){
        $books = Book::all();
        return view('admin.ListProduct', compact('books'));
    }
    
    /* add product */
    public function getAddProduct(){
        return view('admin.AddProduct');
    }
    public function postAddProduct(){
        
    }

    /* product description */
    public function productDescription($id){
        $book = Book::find($id);
        $image = $book->images->first();
        $category = Category::findOrFail($book->category_id);
        $author = Author::findOrFail($book->author_id);
        
        return view('admin.InfoProduct', compact('image', 'book', 'category', 'author'));
    }
    
    /* delete book */
    public function deleteProduct($id){
        $book = Book::find($id);
        $book->delete();
        return redirect('list.product');
    }
    
    /*
     * bill manager
     * */
    public function getListBill(){
        $bills = Bill::all();

        return view('admin.ListBill', compact('bills'));
    }
    
    /* info user */
    public function infoUser($id){
        $account = User::find($id);
        return view('admin.InfoUser', compact('account'));
    }
    
    /* detail bill */
    public function detailBill($id){
        $bill = Bill::find($id);
        $order = $bill->orders;
        $user = $bill->users;
        $cart_books = $order->cartBooks;
        
        // calculate total cost for each bill
        $total = 0;
        foreach ($cart_books as $cb){
            $book = $cb->books;
            $total += $book->new_price*$cb->quantity;
        }
        $order->total_cost = $total;
        $order->save;

        return view('admin.DetailBill', compact('bill', 'order', 'user', 'cart_books'));
    }
    
    /* change status */
    public function changeStatus(){
        $status = Input::get('status');
        $bill_id = Input::get('bill_id');
        $user_id = Input::get('user_id');
        $bill = Bill::find($bill_id);
        if ($bill){
            $bill->status = $status;
            $bill->save();
        }
        if ($user_id){
            $route = "account.bill-$user_id";
            return redirect($route);
        }
        return redirect('bill.list');
    }

    /* delete bill */
    public function deleteBill($id){
        $bill = Bill::find($id);
        $bill->delete();
        return redirect('bill.list');
    }
}
