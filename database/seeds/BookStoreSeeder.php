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
        factory(App\Book::class, 500)->create();
        // factory(App\Image::class, 200)->create();
        factory(App\Author::class, 10)->create();
        factory(App\CartBook::class, 10)->create();
        factory(App\Rate::class, 100)->create();
        $this->fakeCategory();
    }

    public function fakeCategory()
    {
        $categoryNames = [
            'Biographies & Memoirs',
            'Business & Investing',
            "Children's Books",
            'Comics',
            'Computers & Technology',
            'Cooking, Food & Wine',
            'Fiction & Literary Collections',
            'Foreign Language & Study Aids',
            'Health, Mind & Body',
            'History',
            'Parenting & Families',
            'Religion & Spirituality',
            'Science & Math',
            'Travel'
        ];

        $faker = Faker\Factory::create();

        foreach ($categoryNames as $key => $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'image_url' => $faker->imageUrl(320, 222)
            ]);
        }
    }
}
