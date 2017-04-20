<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadCommentsLikesdislikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_comment_likes_dislikes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('thread_comment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('is_liked_disliked')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->foreign('thread_comment_id')->references('id')->on('thread_comments');
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
        Schema::table('thread_comment_likes_dislikes', function (Blueprint $table) {
            $table->dropForeign(['thread_comment_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('thread_comment_likes_dislikes');
    }
}
