<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {

    return [
        'name' => $faker->company,
        'phone' => $faker->firstname,
        'address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'rif' => 'J'.$faker->ean8,
        'email' => $faker->unique()->safeEmail
    ];
});
