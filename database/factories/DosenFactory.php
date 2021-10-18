<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dosen;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Dosen::class, function (Faker $faker) {
    return [
        'nidn' => $faker->randomNumber(8),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'no_hp' => $faker->randomNumber(8),
        'jen_kel' => config('constant.jen_kel')[array_rand(config('constant.jen_kel'), 1)],
        'keahlian' => $faker->jobTitle,
    ];
});
