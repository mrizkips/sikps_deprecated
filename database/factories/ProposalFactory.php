<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use Faker\Generator as Faker;

$factory->define(Proposal::class, function (Faker $faker) {
    return [
        'judul' => $faker->sentence(),
        'jenis' => $faker->randomElement(['1','2']),
        'mahasiswa_id' => function() {
            return factory(Mahasiswa::class)->create()->id;
        },
        'dokumen' => $faker->fileExtension,
        'pendaftaran_id' => function() {
            return factory(Pendaftaran::class)->create()->id;
        },
        'dosen_id' => function() {
            return factory(Dosen::class)->create()->id;
        },
        'tempat_kp' => $faker->company,
    ];
});
