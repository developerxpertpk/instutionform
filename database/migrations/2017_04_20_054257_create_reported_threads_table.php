<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported_threads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('reporting_type');
            $table->longText('reporting_reason');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('thread_id')->references('id')->on('threads');
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
        Schema::table('reported_threads', function (Blueprint $table) {
            $table->dropForeign(['thread_id']);
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('reported_threads');
    }
}
