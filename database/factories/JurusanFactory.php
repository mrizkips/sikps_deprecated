<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Jurusan;
use Faker\Generator as Faker;

$factory->define(Jurusan::class, function (Faker $faker) {
    return [
        'nama' => $faker->sentence()
    ];
});
