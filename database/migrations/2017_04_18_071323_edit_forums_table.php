<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forums',function(Blueprint $table){
            $table->longText('description')->change();
        });

        Schema::table('threads',function(Blueprint $table){
            $table->longText('description')->change();
        });
        
        Schema::table('reportedforums',function(Blueprint $table){
            $table->longText('reporting_reason')->change();
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
    }
}
