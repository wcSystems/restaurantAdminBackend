<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(10,true),
        'category_product_id' => rand(1,14),
        'measure_unit_id' => rand(1,4)
    ];
});
