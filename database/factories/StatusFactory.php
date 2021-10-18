<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Proposal;
use App\Models\Sidang;
use App\Models\Status;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'tipe' => '0',
        'statusable_id' => $faker->randomDigit,
        'statusable_type' => Str::random(6),
    ];
});
