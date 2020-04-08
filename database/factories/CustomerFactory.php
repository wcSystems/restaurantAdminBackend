<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {

    return [
        'identity_card' => $faker->numberBetween($min = 1000000, $max = 30000000),
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastName,
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail
    ];
});
