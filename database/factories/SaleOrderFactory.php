<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SaleOrder;
use Faker\Generator as Faker;

$factory->define(SaleOrder::class, function (Faker $faker) {
    return [
        'num_invoice' => $faker->isbn10,
        'date' => $faker->dateTimeBetween('-30 days', 'now'),
        'required_date' => $faker->dateTimeBetween('-30 days', 'now'),
        'shipped_date' => $faker->dateTimeBetween('-30 days', 'now'),
        'status_order_id' => $faker->numberBetween(1,5),
        'customer_id' => $faker->numberBetween(1,50),
        'order_type_id' => $faker->numberBetween(1,3),
        'user_id' => $faker->numberBetween(1,10),
        'comment' => $faker->sentence(20, true)
    ];
});
