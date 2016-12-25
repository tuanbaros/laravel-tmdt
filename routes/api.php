<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/category', 'CategoryController', [ 'only' => [
    'index', 'show'
]]);

Route::resource('/cart', 'CartController', [ 'only' => [
    'show'
]]);

Route::resource('/author', 'AuthorController', [ 'only' => [
    'show'
]]);

Route::resource('/bill', 'BillController', [ 'only' => [
    'show'
]]);

Route::get('/book/{book_id}/{user_id?}', 'BookController@show');

Route::resource('/rate', 'RateController', [ 'only' => [
    'show'
]]);

Route::resource('/status', 'StatusController', [ 'only' => [
    'show'
]]);

Route::post('/login', [
    'as' => 'auth.login',
    'uses' => 'AuthController@login'
]);

Route::post('/logout', [
    'as' => 'auth.logout',
    'uses' => 'AuthController@logout'
]);

Route::get('/search/{key}', [
    'as' => 'search',
    'uses' => 'SearchController@search'
]);

Route::group(['prefix' => 'user'], function() {
    Route::post('rate/store', [
        'as' => 'user.rate.store',
        'uses' => 'UserController@storeRate'
    ]);

    Route::post('book', [
        'as' => 'user.book',
        'uses' => 'UserController@getBook'
    ]);

    Route::post('review/store', [
        'as' => 'user.review.store',
        'uses' => 'UserController@storeReview'
    ]);

    Route::post('bill/store', [
        'as' => 'user.bill.store',
        'uses' => 'UserController@storeBill'
    ]);
});
