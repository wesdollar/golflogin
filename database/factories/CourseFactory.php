<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        "group_id" => 3,
        "title" => $faker->company,
        "tee_box" => $faker->colorName,
        "rating" => 73.2,
        "slope" => 130,
        "user_id" => 1
    ];
});
