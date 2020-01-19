<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'accuracy' => rand(5,10),
        'discipline' => rand(5,10),
        'skill' => rand(5,10),
        'speed' => rand(5,10),
        'teamwork' => rand(5,10),
    ];
});
