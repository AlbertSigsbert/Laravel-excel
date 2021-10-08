<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
       'items'=> $faker->word(),
       'descriptions' => $faker->optional()->paragraph(),
       'quantity' => $faker->randomDigit(),
       'units'=> $faker->numberBetween(0, 100)

    ];
});
