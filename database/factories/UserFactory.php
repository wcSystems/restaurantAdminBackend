<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'img_profile' => $faker->imageUrl(512,512),
        'password' => '$2y$10$dJNlL4bv0J5kGxuxMHfE5ezqUqb73yQ7t7fBSZTa2CEifswkmeHy.',
        'role_id' => rand(2,4),
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10)
    ];
});
