<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $prod = $this->faker->unique()->words($nb=5, $asText=true);
	$slug = Str::slug($prod);
    return [
    	'product_name'=>$prod,
    	'slug'=>$slug,
    	'details'=>$this->faker->text(200),
    	'regular_price'=>$this->faker->numberBetween(100, 10000),
    	'sale_price'=>$this->faker->numberBetween(0, 10000),
    	'description'=>$this->faker->text(500),
    	'stock_status'=>'instock',
    	'image'=>'images/products/digital_'.$this->faker->unique()->numberBetween(1, 22).'.jpg',
    	'category_id'=>$this->faker->numberBetween(1, 5),
    ];
});
