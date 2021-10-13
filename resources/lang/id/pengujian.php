<?php

return [
    '_' => 'Pengujian',
    'fields' => [
        'pendaftaran_id' => 'Periode Pendaftaran',
        'jadwal_sidang_id' => 'Jadwal Sidang',
        'sidang_id' => 'Pengajuan Sidang',
        'dosen_id' => 'Dosen Penguji',
        'nilai_ppt' => 'Penilaian Presentasi',
        'nilai_laporan' => 'Penilaian Laporan',
        'nilai_aplikasi' => 'Penilaian Aplikasi',
    ],
    'placeholders' => [
        'pendaftaran_id' => 'Pilih Periode Pendaftaran',
        'jadwal_sidang_id' => 'Pilih Jadwal Sidang',
        'sidang_id' => 'Pilih Pengajuan Sidang',
        'dosen_id' => 'Masukkan Dosen Penguji',
        'nilai_ppt' => 'Masukkan Penilaian Presentasi (0 - 100)',
        'nilai_laporan' => 'Masukkan Penilaian Laporan (0 - 100)',
        'nilai_aplikasi' => 'Masukkan Penilaian Aplikasi (0 - 100)',
    ],
    'messages' => [
        'success' => [
            'create' => 'Pengujian berhasil ditambahkan.',
            'update' => 'Pengujian berhasil diubah.',
            'delete' => 'Pengujian berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan pengujian.',
            'update' => 'Gagal merubah pengujian.',
            'delete' => 'Gagal menghapus pengujian.',
            'not_found' => 'Pengujian tidak ditemukan.',
            'is_pembimbing' => 'Dosen penguji tidak boleh sama dengan dosen pembimbing.',
            'is_existed' => 'Pengujian sudah ditambahkan di jadwal yang sama.',
        ],
    ]
];
