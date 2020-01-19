<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recomendation;
use Faker\Generator as Faker;

$factory->define(Recomendation::class, function (Faker $faker) {
    return [
        'status' => Recomendation::PENDING,
    ];
});
