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
        Schema::disableForeignKeyConstraints();
        // $this->down();
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('publisher_id')->references('id')->on('publishers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('author_id');
            $table->dropColumn('genre_id');
            $table->dropColumn('city_id');
            $table->dropColumn('publisher_id');
        });
    }
};
