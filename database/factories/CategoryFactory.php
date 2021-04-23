<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$category = $this->faker->unique()->words($nb=2, $asText=true);
	$slug = Str::slug($category);
    return [
    	'category_name'=>$category,
    	'slug'=>$slug
    ];
});
