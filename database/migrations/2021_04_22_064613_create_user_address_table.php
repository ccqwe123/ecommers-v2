<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('fullname');
            $table->string('telephone');
            $table->text('address_description')->nullable();
            $table->string('house_info');
            $table->enum('status', ['0', '1'])->default('0');
            $table->bigInteger('province_id');
            $table->bigInteger('city_id');
            $table->bigInteger('barangay_id');
            $table->timestamps();
        });

        Schema::create('user_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
        });

        Schema::create('user_provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
        });

        Schema::create('user_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
            $table->string('city_id', 6)->index();

            $table->index(['province_id', 'region_id'], 'cities_province_regions');
        });

        Schema::create('user_barangays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
            $table->string('city_id', 6)->index();

            $table->index(['province_id', 'region_id'], 'barangay_idx_1');
            $table->index(['city_id', 'province_id', 'region_id'], 'barangay_idx_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('user_regions');
        Schema::dropIfExists('user_provinces');
        Schema::dropIfExists('user_cities');
        Schema::dropIfExists('user_barangays');
    }
}
