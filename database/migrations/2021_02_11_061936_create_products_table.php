<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            $table->string('product_name')->nullable();
            $table->string('slug')->unique();
            $table->string('details')->nullable();
            $table->string('regular_price');
            $table->string('sale_price')->nullable();
            $table->string('new')->nullable();
            $table->string('promo')->nullable();
            $table->string('sale')->nullable();
            $table->text('description')->nullable();;
            $table->enum('stock_status', ['instock','outofstock'])->default('instock');
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
