<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FriendLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('friend_lists', function (Blueprint $table) {
             $table->increments('id');
             $table->uuid('user_id')->nullable();
             $table->uuid('user_id_friend')->nullable();
             $table->boolean('are_friend')->nullable();
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
        Schema::drop('friend_lists');
    }
}
