<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PurchaseOrder;
use Faker\Generator as Faker;

$factory->define(PurchaseOrder::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('-30 days', 'now'),
        'num_invoice' => $faker->isbn10,
        'required_date' => $faker->dateTimeBetween('-30 days', 'now'),
        'purchase_date' => $faker->dateTimeBetween('-30 days', 'now'),
        'arrival_date' => $faker->dateTimeBetween('-30 days', 'now'),
        'provider_id' => $faker->numberBetween(1,20),
        'user_id' => $faker->numberBetween(1,10)
    ];
});
