<?php

return [
    '_' => 'Jadwal Sidang',
    'fields' => [
        'pendaftaran_id' => 'Periode Pendaftaran' ,
        'tanggal' => 'Tanggal',
        'mulai' => 'Jam Mulai',
        'selesai' => 'Jam Selesai',
        'catatan' => 'Catatan',
    ],
    'placeholders' => [
        'pendaftaran_id' => 'Pilih periode pendaftaran' ,
        'tanggal' => 'Masukkan tanggal',
        'mulai' => 'Masukkan jam mulai',
        'selesai' => 'Masukkan jam selesai',
        'catatan' => 'Catatan (opsional)',
    ],
    'messages' => [
        'success' => [
            'create' => 'Jadwal Sidang berhasil ditambahkan.',
            'update' => 'Jadwal Sidang berhasil diubah.',
            'delete' => 'Jadwal Sidang berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan jadwal sidang.',
            'update' => 'Gagal merubah jadwal sidang.',
            'delete' => 'Gagal menghapus jadwal sidang.',
            'not_found' => 'Jadwal Sidang tidak ditemukan.',
        ],
    ]
];
