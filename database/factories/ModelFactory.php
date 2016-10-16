<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'approved' => 0,
        'address' => $faker->address(),
        'lat' => $faker->latitude(),
        'lng' => $faker->longitude(),
    ];
});

$factory->define(App\Comment::class, function(Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph()
    ];
});

$factory->define(App\Tag::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence()
    ];
});