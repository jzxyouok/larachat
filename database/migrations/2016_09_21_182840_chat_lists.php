<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('chat_lists', function (Blueprint $table) {
             $table->string('id');
             $table->uuid('message_id')->nullable();
             $table->uuid('user_id')->nullable();
             $table->boolean('status')->nullable();
             $table->timestamp('created_at')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chat_lists');
    }
}
