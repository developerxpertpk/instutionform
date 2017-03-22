<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

     Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name');
            $table->string('school_address');
            $table->boolean('status')->default(0);
            $table->integer('location_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('location_id')
                ->references('id')->on('locations');
       });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::table('schools', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });

        Schema::dropIfExists('schools');


    }
}
