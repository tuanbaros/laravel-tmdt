<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('admin.LogInAdmin');
});

/*Auth::routes();

Route::get('/home', 'HomeController@index');*/

Route::get('test', function () {
    App\CustomerReview::create(['book_id'=>'1', 'user_id'=>'1', 'content'=>'dfsdf fsf sfds']);
    return App\User::first()->customerReviews;
});


//
Route::get('manager',function() {
    if (!Session::has('loginadmin')) {
        return Redirect::to('loginadmin');
    }
    return view('admin.StartAdmin');
});

// login and logout admin
Route::get('loginadmin',function() {
    if(!Session::has('loginadmin')){
        return view('admin.LogInAdmin');
    }
    return redirect('manager');
});

use \Illuminate\Support\Facades\Input;
Route::post('loginadmin',function() {
    if (Input::get('username')=="admin" && Input::get('password')=="admin") {
        Session::put('loginadmin', 'ok');
        return Redirect::to('manager');
    }
    return view('admin.LogInAdmin');
});
Route::get('login.html', function() {
    Session::forget('loginadmin');
    return Redirect::to('loginadmin');
});

// account manager
Route::get('account.manager', 'AdminController@getListAccount');
Route::get('account.delete-{id}', 'AdminController@deleteAccount');
Route::get('account.bill-{id}', 'AdminController@listBillForEachAccount');
Route::get('account.cart-{id}', 'AdminController@cart');
Route::get('cart_item.delete-{id}', 'AdminController@deleteCartItem');

// book manager
Route::get('list.product', 'AdminController@getListProduct');
Route::get('product.add', 'AdminController@getAddProduct');
Route::post('product.add', 'AdminController@postAddProduct');
Route::get('product.description-{id}', 'AdminController@productDescription');
Route::get('product.delete-{id}', 'AdminController@deleteProduct');

// bill manager
Route::get('bill.list', 'AdminController@getListBill');
Route::get('bill.account-{id}', 'AdminController@infoUser');
Route::get('bill.detail-{id}', 'AdminController@detailBill');
Route::get('bill.change.status', 'AdminController@changeStatus');
Route::get('bill.delete-{id}', 'AdminController@deleteBill');
