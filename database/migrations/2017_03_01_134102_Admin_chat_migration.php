<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminChatMigration extends Migration
{
    public function up()
    {
        Schema::create('adminchats', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->integer('user_id')->unsigned();
            $table->integer('admin_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('content');
            $table->integer('status');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adminchats');
    }
}
