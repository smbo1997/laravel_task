<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProducttsTableMigration extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('type_id')->references('type_id')->on('producttypes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_name');
            $table->string('product_content');
            $table->integer('product_price');
            $table->string('product_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
