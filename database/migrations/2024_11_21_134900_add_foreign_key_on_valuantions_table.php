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
        Schema::table('valuations', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valuations', function (Blueprint $table) {
            $table->dropColumn('module_id');
            $table->dropColumn('lesson_id');
            $table->dropColumn('user_id');
        });
    }
};
