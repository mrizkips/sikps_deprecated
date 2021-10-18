<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Models\Sidang;
use Faker\Generator as Faker;

$factory->define(Sidang::class, function (Faker $faker) {
    return [
        'jenis' => $faker->randomElement(['1','2','3']),
        'proposal_id' => function() {
            return factory(Proposal::class)->create()->id;
        },
        'pendaftaran_id' => function() {
            return factory(Pendaftaran::class)->create()->id;
        },
        'laporan' => $faker->fileExtension,
        'penilaian_kp' => $faker->fileExtension,
        'catatan' => $faker->sentence(),
    ];
});
