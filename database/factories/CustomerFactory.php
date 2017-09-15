<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;

$factory->define(Customer::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});