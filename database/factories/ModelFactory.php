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
        'book_id' => $faker->numberBetween(1, 500),
        'user_id' => $faker->numberBetween(1, 20),
        'content' => $faker->text,
    ];
});

$factory->define(App\Cart::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, 20),
        'total_cost' => $faker->randomFloat(2, 1, 100),
    ];
});

// $factory->define(App\Rate::class, function (Faker\Generator $faker) {
//     return [
//         'book_id' =>$faker->numberBetween(1, 10),
//         'user_id' => $faker->numberBetween(1, 20),
//     ];
// });

$factory->define(App\Bill::class, function (Faker\Generator $faker) {
    return [
        'user_id' =>$faker->numberBetween(1, 20),
        'cart_id' => $faker->numberBetween(1, 20),
        'status' => $faker->randomElement(['processing', 'shipping', 'completed', 'cancel']),
        'name_customer' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,

    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    $discount = $faker->numberBetween(1, 50);
    $price = $faker->randomFloat(2, 1, 100);
    $new_price = $price - $price * $discount / 100;
    return [
        'title' => rtrim($faker->text(40), '.'),
        'author_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 14),
        'price' => $price,
        'new_price' => $new_price,
        'language' => $faker->languageCode,
        'discount_percent' => $discount,
        'description' => $faker->text,
        'rate_average' => $faker->randomFloat(1, 0, 5),
        'quantity_selling' => $faker->numberBetween(20, 50),
        'quantity_remain' => $faker->numberBetween(20, 50),
        'date_releases' => $faker->dateTime,
        'image_url' => $faker->imageUrl(222, 320),

    ];
});

// $factory->define(App\Image::class, function (Faker\Generator $faker) {
//     return [
//         'book_id' =>$faker->numberBetween(1, 100),
//         'url' => $faker->imageUrl(222, 320),
//         'description' => $faker->text,
//     ];
// });

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    return [
        'name' =>$faker->name,
        'introduce' => $faker->text,
        'contact' => $faker->address,
        'avatar' => $faker->imageUrl(222, 222),
    ];
});

$factory->define(App\CartBook::class, function (Faker\Generator $faker) {
    return [
        'cart_id' => $faker->numberBetween(1, 5),
        'book_id' => $faker->numberBetween(1, 100),
        'quantity' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(App\Rate::class, function (Faker\Generator $faker) {
    return [
        'book_id' => $faker->numberBetween(1, 500),
        'user_id' => $faker->numberBetween(1, 20),
        'point' => $faker->numberBetween(1, 5),
    ];
});
