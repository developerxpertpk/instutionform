<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumLikedislikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_likes_dislikes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('forum_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('is_liked_disliked')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('forum_id')->references('id')->on('forums');
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
        Schema::table('forum_likes_dislikes', function (Blueprint $table) {
            $table->dropForeign(['forum_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('forum_likes_dislikes');
    }
}
