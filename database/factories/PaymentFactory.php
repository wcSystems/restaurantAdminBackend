<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween(1,50),
        'date_payment' => $faker->dateTimeBetween('-30 days', 'now'),
        'amount' => $faker->randomFloat(2,10,2000),
        'reference_number' => $faker->ean13,
        'payment_method_id' => $faker->numberBetween(1,6)
    ];
});
