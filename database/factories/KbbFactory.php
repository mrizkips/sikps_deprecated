<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Kbb;
use Faker\Generator as Faker;

$factory->define(Kbb::class, function (Faker $faker) {
    return [
        'nama' => $faker->word()
    ];
});
