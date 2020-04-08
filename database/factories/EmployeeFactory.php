<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    $job = $faker->numberBetween(2,5);

    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->safeEmail,
        'phone' => $faker->tollFreePhoneNumber,
        'job_id' => $job,
        'employee_id' => $job,
        'salary' => $faker->randomFloat(2,100,500)
    ];
});
