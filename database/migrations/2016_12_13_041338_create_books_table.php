<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->integer('author_id');
            $table->integer('category_id');
            $table->float('price');
            $table->float('new_price');
            $table->string('language');
            $table->integer('discount_percent');
            $table->text('description');
            $table->float('rate_average');
            $table->integer('quantity_selling');
            $table->integer('quantity_remain');
            $table->string('date_releases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
