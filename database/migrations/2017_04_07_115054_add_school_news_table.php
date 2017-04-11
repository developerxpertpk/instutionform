<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function  up(){
        Schema::create('school_news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('school_id');
            $table->text('news_title')->nullable();
            $table->text('news_description')->nullable();
            $table->integer('status')->default(0);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')->on('schools')->onDelete('cascade');

        });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            //
            Schema::dropIfExists('school_news');
        }
}
