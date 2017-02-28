<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->integer('from_id');
            $table->integer('to_id');
//            $table->foreign('from_id')->references('id')->on('users');
//            $table->foreign('to_id')->references('id')->on('users');
            $table->string('content');
            $table->integer('status');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
