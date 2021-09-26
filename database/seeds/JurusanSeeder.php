<?php

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            'Teknik Informatika',
            'Sistem Informasi',
        ];

        foreach ($jurusan as $item) {
            Jurusan::create(['nama' => $item]);
        }
    }
}
