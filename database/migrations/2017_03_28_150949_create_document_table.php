<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('documents', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->string('document');
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
         Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
        });
          Schema::dropIfExists('documents');
    }
}
