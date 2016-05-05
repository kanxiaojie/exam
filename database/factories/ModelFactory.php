<?php


use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'student_id' => mt_rand(10000, 99999),
        'role_id' => '1',
        'name' => $faker->name,
//        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'student_id' => mt_rand(10000, 99999),
        'role_id' => '2',
        'name' => $faker->name,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Module::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});

$factory->define(App\CourseTime::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Module::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 76,
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Exam::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 6,
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});

