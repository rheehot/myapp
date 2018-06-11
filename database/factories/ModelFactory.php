<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Article::class, function (Faker $faker) {
    $date = $faker->dateTimeThisMonth;

    return [
        'title'      => $faker->sentence(),
        'content'    => $faker->paragraph(),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});