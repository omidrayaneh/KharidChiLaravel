<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhotoProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_product', function (Blueprint $table) {

            $table->unsignedBigInteger('photo_id');
            $table->foreign('photo_id')->references('id')->on('photos');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_product');
    }
}
