<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Jurusan;
use App\Models\Kbb;
use App\Models\Mahasiswa;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => $faker->randomNumber(7),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'no_hp' => $faker->randomNumber(8),
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => $faker->date(),
        'jen_kel' => config('constant.jen_kel')[array_rand(config('constant.jen_kel'), 1)],
        'kbb_id' => function() {
            return factory(Kbb::class)->create()->id;
        },
        'jurusan_id' => function() {
            return factory(Jurusan::class)->create()->id;
        },
        'alamat' => $faker->address,
    ];
});
