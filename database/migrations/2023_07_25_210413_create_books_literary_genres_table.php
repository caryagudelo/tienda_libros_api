<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_literary_genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('literary_genre_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();

         
            $table->foreign('literary_genre_id')->references('id')->on('literary_genres')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::table('books_literary_genres', function (Blueprint $table) {
            $table->dropForeign(['literary_genre_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::dropIfExists('books_literary_genres');
    }
};