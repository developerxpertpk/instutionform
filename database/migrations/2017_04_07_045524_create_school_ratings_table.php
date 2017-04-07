<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('school_ratings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('ratings');
            $table->text('reviews')->nullable();
            $table->timestamps();

            $table->foreign('school_id')
                                    ->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('user_id')
                                    ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_ratings', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('school_ratings');
    }
}
