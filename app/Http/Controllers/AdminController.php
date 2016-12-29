<?php

namespace App\Http\Controllers;

use App\Author;
use App\Bill;
use App\Book;
use App\CartBook;
use App\Category;
use App\Image;
use App\User;
use App\Order;
use Illuminate\Http\Request;
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

            return view('admin.Cart', compact('total_cost', 'cart_books'));
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
        if (isset($_POST['product_add'])){
            $book = new Book;
            $book->title = $_POST['title'];
            // add author
            $author = new Author;
            $author->name = $_POST['author_name'];
            $author->introduce = $_POST['author_introduce'];
            $author->contact = $_POST['author_contact'];
            $author->avatar = "http://lorempixel.com/222/222/?78400";
            $author->save();

            $book->author_id = $author->id;

            $category_id = Category::where('name', $_POST['category'])->first()->id;
            $book->category_id = $category_id;

            $book->language = $_POST['language'];
            $book->price = $_POST['price'];
            if ($_POST['discount_percent']==0){
                $book->new_price = $_POST['price'];
            }else{
                $book->new_price = $_POST['price']*(1-$_POST['discount_percent']/100);
            }

            $book->rate_average = 0;
            $book->discount_percent = $_POST['discount_percent'];
            $book->quantity_remain = $_POST['quantity_remain'];
            $book->quantity_selling = 0;
            $book->description = $_POST['description'];
            $book->date_releases = $_POST['date_releases'];
            $book->image_url = "http://lorempixel.com/222/320/?48483";
            $book->save();

            $image = new Image;
            $image->book_id = $book->id;
            $image->url = "http://lorempixel.com/222/320/?48483";
            $image->description = $book->title;
            $image->save();

            return redirect('list.product');
        }else{
            echo "Thêm sản phẩm mới không thành công!";
        }
    }

    /* product description */
    public function productDescription($id){
        $book = Book::find($id);
        $image = new Image;
        $image->url = $book->image_url;
        $image->description = $book->title;
        if (!$image){
            $image = $book->images->first();
        }
        $category = Category::findOrFail($book->category_id);
        $author = Author::findOrFail($book->author_id);
        
        return view('admin.InfoProduct', compact('image', 'book', 'category', 'author'));
    }
    
    /* edit book */
    public function getEditProduct($id){
        $book = Book::find($id);
        $author = Author::findOrFail($book->author_id);
        $category = Category::findOrFail($book->category_id);
        return view('admin.EditProduct',compact('book', 'author', 'category'));
    }

    public function postEditProduct($id){
        if (isset($_POST['product_edit'])){
            $book = Book::find($id);
            $book->title = $_POST['title'];
            // edit author
            $author = Author::findOrFail($book->author_id);
            $author->name = $_POST['author_name'];
            $author->introduce = $_POST['author_introduce'];
            $author->contact = $_POST['author_contact'];
            $author->save();
            // edit category
            $category_id = Category::where('name', $_POST['category'])->first()->id;
            $book->category_id = $category_id;

            $book->language = $_POST['language'];
            $book->price = $_POST['price'];
            if ($_POST['discount_percent']==0){
                $book->new_price = $_POST['price'];
            }else{
                $book->new_price = $_POST['price']*(1-$_POST['discount_percent']/100);
            }

            $book->discount_percent = $_POST['discount_percent'];
            $book->quantity_remain = $_POST['quantity_remain'];
            $book->description = $_POST['description'];
            $book->date_releases = $_POST['date_releases'];
            $book->save();

            /*$image = new Image;
            $image->book_id = $book->id;
            $image->url = "http://lorempixel.com/222/320/?48483";
            $image->description = $book->title;
            $image->save();*/

            return redirect('list.product');
        }else{
            echo "Sửa sản phẩm không thành công!";
        }
    }
    
    /* delete book */
    public function deleteProduct($id){
        $book = Book::find($id);
        $book->delete();
        return redirect('list.product');
    }
    
    /*
     * statistic manager
     * */
    /* list product sale */
    public function getListProductSale(){
        $books = Book::where('discount_percent','>',0)->get();
        return view('admin.ListProductSale', compact('books'));
    }

    /* list product best selling */
    public function getListProductBestSelling(){
        $books = Book::orderBy('quantity_selling', 'desc')->take(10)->get();
        return view('admin.ListProductBestSelling', compact('books'));
    }

    /* list product sold out */
    public function getListProductSoldOut(){
        $books = Book::where('quantity_remain', '=', 0)->get();
        return view('admin.ListProductSoldOut', compact('books'));
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
        if ($status == 'cancel') {
            foreach ($bill->orders->cartbooks as $key => $cartbook) {
                $book = $cartbook->books;
                $book->quantity_selling -= $cartbook->quantity;
                $book->quantity_remain += $cartbook->quantity;
                $book->save();
                $cartbook->delete();
            }
            $bill->orders->delete();
        }
        return redirect()->back();
    }

    /* delete bill */
    public function deleteBill($id){
        $bill = Bill::find($id);
        $bill->delete();
        return redirect()->back();
    }
}
