<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('publisher_id');
            $table->string('book_name',255);
            $table->integer('price')->nullable();
            $table->text('describe')->nullable();
            $table->json('image')->nullable();
            $table->tinyInteger('is_sale')->nullable();
            $table->tinyInteger('percent')->nullable();
            $table->tinyInteger('vote')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('amount')->nullable();
            $table->char('year_publish',10)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
