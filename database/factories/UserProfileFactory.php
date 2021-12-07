<?php

use Faker\Generator as Faker;

$factory->define(App\UserProfile::class, function (Faker $faker) {
    return [
        'bio' => $faker->paragraph,
        'github' => $faker->unique()->url,
        'annual_salary' => rand(0, 2) ? $faker->numberBetween($min = 10000, $max = 100000) : null,
    ];
});
