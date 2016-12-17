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

// book manager
Route::get('list.product', 'AdminController@getListProduct');
