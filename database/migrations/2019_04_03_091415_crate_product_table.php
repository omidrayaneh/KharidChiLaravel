<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->tinyInteger('status');
            $table->integer('price');
            $table->integer('discount_price')->nullable();
            $table->text('short_description')->nullable();;
            $table->text('long_description')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();


            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
