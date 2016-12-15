<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    //static $password;

    return [
        'name' => $faker->name,
        //'id_fb' => null,
        //'password' => null,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        //'email' => $faker->unique()->safeEmail,
        'avatar' => 'http://localhost:8000/image/user.png',
        //'fb_token' => null,
        //'token' => null,
        //'password' => $password ?: $password = bcrypt('secret'),
        //'remember_token' => str_random(10),
    ];
});

$factory->define(App\CustomerReview::class, function (Faker\Generator $faker) {

    return [
        'book_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
        'content' => $faker->text,
    ];
});

$factory->define(App\Cart::class, function (Faker\Generator $faker){
    return [
        'user_id' => $faker->unique()->numberBetween(1,20),
        'total_cost' => $faker->randomFloat(2,1,100),
    ];
});

$factory->define(App\Rate::class, function (Faker\Generator $faker){
    return [
        'book_id' =>$faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,20),
    ];
});

$factory->define(App\Bill::class, function (Faker\Generator $faker){
    return [
        'user_id' =>$faker->numberBetween(1,10),
        'cart_id' => $faker->numberBetween(1,10),
        'status' => 'unsold',
        'name_customer' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,

    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker){
    return [
        'title' =>$faker->text(50),
        'author_id' => $faker->numberBetween(1,10),
        'category_id' => $faker->numberBetween(1,5),
        'price' => $faker->randomFloat(2,1,100),
        'new_price' => $faker->randomFloat(2,1,100),
        'language' => $faker->languageCode,
        'discount_percent' => 0,
        'description' => $faker->text,
        'rate_average' => $faker->randomFloat(1,0,5),
        'quantity_selling' => $faker->numberBetween(20,50),
        'quantity_remain' => $faker->numberBetween(50,100),
        'date_releases' => $faker->dateTime,

    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker){
    return [
        'book_id' =>$faker->numberBetween(1,20),
        'url' => 'http://localhost:8000/image/diary-of-a-wimpy-kid.jpg',
        'description' => $faker->text,
    ];
});

$factory->define(App\Author::class, function (Faker\Generator $faker){
    return [
        'name' =>$faker->name,
        'introduce' => $faker->text,
        'contact' => $faker->text(50),
    ];
});
