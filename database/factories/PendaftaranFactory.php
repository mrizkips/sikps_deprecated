<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pendaftaran;
use Faker\Generator as Faker;

$factory->define(Pendaftaran::class, function (Faker $faker) {
    return [
        'judul' => $faker->sentence(),
        'jenis' => $faker->randomElement(['1','2']),
        'awal' => $faker->date(),
        'akhir' => $faker->date(),
        'tanggal_kontrak' => $faker->date(),
    ];
});
