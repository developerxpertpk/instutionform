<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('school_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->integer('school_id')->unsign();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')->on('schools');
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_images', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
        });
          Schema::dropIfExists('school_images');
    }
}
