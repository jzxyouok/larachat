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
             $table->uuid('id');
             $table->uuid('user_id')->nullable();
             $table->uuid('from_id')->nullable();
             $table->uuid('to_id')->nullable();
             $table->boolean('status')->nullable();
             $table->text('data')->nullable();
             $table->string('media_url')->nullable();
             $table->string('media_mime_type')->nullable();
             $table->string('media_size')->nullable();
             $table->string('media_name')->nullable();
             $table->string('media_dir')->nullable();
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
