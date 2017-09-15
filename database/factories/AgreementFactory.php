<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agreement;

$factory->define(Agreement::class, function (Faker\Generator $faker) {

    return [
        'type' => Agreement::TYPE_WEEKLY,
    ];
});