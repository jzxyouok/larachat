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
            $table->uuid('user_id');
            $table->boolean('status');
            $table->text('data');
            $table->string('media_url');
            $table->string('media_mime_type');
            $table->string('media_size');
            $table->string('media_name');
            $table->string('media_dir');
            $table->timestampTz('received_timestamp');
            $table->timestampTz('send_timestamp');
            $table->timestampTz('receipt_server_timestamp');
            $table->timestampTz('receipt_device_timestamp');
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
