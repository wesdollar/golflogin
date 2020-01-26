<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        "owner_id" => 1,
        "title" => $faker->company,
        "enabled" => true,
        "subscribed" => true,
        "group_code" => Str::random(6)
    ];
});
