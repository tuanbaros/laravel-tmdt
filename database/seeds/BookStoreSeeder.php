<?php

use Illuminate\Database\Seeder;

class BookStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();
        factory(App\CustomerReview::class, 20)->create();
        factory(App\Cart::class, 20)->create();
        factory(App\Bill::class, 20)->create();
        factory(App\Book::class, 20)->create();
        factory(App\Image::class, 40)->create();
        factory(App\Author::class, 10)->create();
    }
}
