<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text_one')->nullable();
            $table->string('text_two')->nullable();
            $table->string('text_third')->nullable();
            $table->string('text_fourth')->nullable();
            $table->string('image_banner')->nullable();
            $table->enum('slide_number', ['1', '2','3']);
            $table->enum('bstyle', ['1', '2','3']);
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
        Schema::dropIfExists('banners');
    }
}
