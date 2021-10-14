<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PriceRequest;
use Faker\Generator as Faker;

$factory->define(PriceRequest::class, function (Faker $faker) {
    return [
        'items'=> $faker->word(),
        'descriptions' => $faker->optional()->paragraph(),
        'quantity' => $faker->randomDigit(),
        'units'=> $faker->numberBetween(0, 100),
        'price' => $faker->randomNumber(8, false),
        'cost' => $faker->randomNumber(8, false)
    ];
});
