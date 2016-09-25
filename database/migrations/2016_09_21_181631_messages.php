<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('messages', function (Blueprint $table) {
//             $table->increments('id');
             $table->uuid('id');
             $table->integer('user_id', $AI = false, $unsigned = true);
             $table->text('message');
             $table->integer('room_id');
             $table->integer('to', $AI = false, $unsigned = true);
             $table->timestamps();
             $table->primary('id');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
