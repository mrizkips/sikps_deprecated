<?php

use App\Models\FormPenilaian;
use Illuminate\Database\Seeder;

class FormPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Form Penilaian Perusahaan Kerja Praktek',
                'jenis' => '3',
                'penilai' => '1',
            ],
            [
                'nama' => 'Form Penilaian Penguji Sidang Kerja Praktek',
                'jenis' => '3',
                'penilai' => '2',
            ],
            [
                'nama' => 'Form Penilaian Pembimbing Kerja Praktek',
                'jenis' => '3',
                'penilai' => '4',
            ],
            [
                'nama' => 'Form Penilaian Penguji 1 Pra-Sidang Skripsi',
                'jenis' => '2',
                'penilai' => '2'
            ],
            [
                'nama' => 'Form Penilaian Penguji 2 Pra-Sidang Skripsi',
                'jenis' => '2',
                'penilai' => '3'
            ],
            [
                'nama' => 'Form Penilaian Pembimbing Pra-Sidang Skripsi',
                'jenis' => '2',
                'penilai' => '4'
            ],
            [
                'nama' => 'Form Penilaian Ujian Komprehensif',
                'jenis' => '2',
                'penilai' => '1'
            ],
            [
                'nama' => 'Form Penilaian Sidang Skripsi - Penguji 1',
                'jenis' => '1',
                'penilai' => '2'
            ],
            [
                'nama' => 'Form Penilaian Sidang Skripsi - Penguji 2',
                'jenis' => '1',
                'penilai' => '3'
            ],
            [
                'nama' => 'Form Penilaian Sidang Skripsi - Pembimbing',
                'jenis' => '1',
                'penilai' => '4'
            ],
        ];

        foreach ($data as $value) {
            FormPenilaian::create($value);
        }
    }
}
