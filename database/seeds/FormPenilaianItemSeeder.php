<?php

use App\Models\FormPenilaianItem;
use Illuminate\Database\Seeder;

class FormPenilaianItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Penilaian Perusahaan KP
            [
                    'form_penilaian_id' => '1',
                    'nama' => 'Kehadiran', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Ketepatan waktu', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Mematuhi tata tertib', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Pemahaman masalah', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Analisis masalah', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Pengenalan sistem', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Perancangan sistem', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Analisis sistem', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Implementasi', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Pemrograman', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Kerjasama', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Hubungan dengan karyawan', 'min' => 0, 'max' => 100,
                ],
                [
                    'form_penilaian_id' => '1',
                    'nama' => 'Etika', 'min' => 0, 'max' => 100,
            ],
            // Penilaian Penguji KP
            [
                    'form_penilaian_id' => '2',
                    'nama' => 'Kompleksitas Tugas', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Presentasi', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Tanya Jawab', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Metodologi Pengembangan Sistem', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Pemilihan Tools Analisis', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Konsisten Penggunaan Tools', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Struktur File', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Sistem Basis Data', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Algoritma', 'min' => 1, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '2',
                    'nama' => 'Teknik Pemrograman', 'min' => 1, 'max' => 3,
            ],
            // Penilaian Pembimbing KP
            [
                    'form_penilaian_id' => '3',
                    'nama' => 'Kompleksitas Tugas', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Presentasi', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Tanya Jawab', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Sistematika Penulisan Laporan', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Penguasaan Materi', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Kesimpulan dan Saran', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Daftar Pustaka', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Kerapihan', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Kedisiplinan', 'min' => 1, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '3',
                    'nama' => 'Teknik Pemrograman', 'min' => 1, 'max' => 5,
            ],
            // Penilaian Penguji 1 Pra-Skripsi
            [
                'form_penilaian_id' => '4',
                'nama' => 'Penilaian Penguji 1', 'min' => 1, 'max' => 10,
            ],
            // Penilaian Penguji 2 Pra-Skripsi
            [
                'form_penilaian_id' => '5',
                'nama' => 'Penilaian Penguji 2', 'min' => 1, 'max' => 10,
            ],
            // Penilaian Pembimbing Pra-Skripsi
            [
                'form_penilaian_id' => '6',
                'nama' => 'Penilaian Pembimbing', 'min' => 1, 'max' => 10,
            ],
            // Penilaian Ujian Komprehensif
            [
                    'form_penilaian_id' => '7',
                    'nama' => 'Interface Dasar I/O', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Proses Fungsional', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Repetisi, Kondisional', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Sub Program', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'SQL', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Relasi Tabel', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Create Tabel/Create Shape/Create File', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Visual Interface', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Operasi File/Operasi Button', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '7',
                    'nama' => 'Tools yang digunakan',
            ],
            // Penilaian Penguji 1 Sidang Akhir Skripsi
            [
                    'form_penilaian_id' => '8',
                    'nama' => 'Presentasi', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '8',
                    'nama' => 'Tata Tulis', 'min' => 0, 'max' => 5,
                ],
                [
                    'form_penilaian_id' => '8',
                    'nama' => 'Pemahaman Sistem', 'min' => 0, 'max' => 6,
                ],
                [
                    'form_penilaian_id' => '8',
                    'nama' => 'Kompleksitas', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '8',
                    'nama' => 'Hasil Kerja', 'min' => 0, 'max' => 2,
            ],
            // Penilaian Penguji 2 Sidang Akhir Skripsi
            [
                    'form_penilaian_id' => '9',
                    'nama' => 'Presentasi', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '9',
                    'nama' => 'Pemahaman Sistem', 'min' => 0, 'max' => 6,
                ],
                [
                    'form_penilaian_id' => '9',
                    'nama' => 'Analisis & Desain Sistem', 'min' => 0, 'max' => 7,
                ],
                [
                    'form_penilaian_id' => '9',
                    'nama' => 'Kompleksitas', 'min' => 0, 'max' => 3,
                ],
                [
                    'form_penilaian_id' => '9',
                    'nama' => 'Hasil Kerja', 'min' => 0, 'max' => 2,
            ],
            // Penilaian Pembimbing Sidang Akhir Skripsi
            [
                    'form_penilaian_id' => '10',
                    'nama' => 'Ketekunan dan Kedisiplinan', 'min' => 0, 'max' => 10,
                ],
                [
                    'form_penilaian_id' => '10',
                    'nama' => 'Pemahaman Sistem dan Kompleksitas', 'min' => 0, 'max' => 6,
                ],
                [
                    'form_penilaian_id' => '10',
                    'nama' => 'Presentasi', 'min' => 0, 'max' => 2,
                ],
                [
                    'form_penilaian_id' => '10',
                    'nama' => 'Analisis dan Desain', 'min' => 0, 'max' => 6,
                ],
                [
                    'form_penilaian_id' => '10',
                    'nama' => 'Hasil Kerja', 'min' => 0, 'max' => 6,
            ],
        ];

        foreach ($data as $value) {
            FormPenilaianItem::create($value);
        }
    }
}
