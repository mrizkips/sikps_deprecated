<?php

return [
    '_' => 'Jadwal',
    'fields' => [
        'tanggal' => 'Tanggal',
        'mulai' => 'Jam Mulai',
        'selesai' => 'Jam Selesai',
        'link' => 'Link',
        'catatan' => 'Catatan',
    ],
    'placeholders' => [
        'tanggal' => 'Masukkan tanggal',
        'mulai' => 'Masukkan jam mulai',
        'selesai' => 'Masukkan jam selesai',
        'link' => 'Link (opsional)',
        'catatan' => 'Catatan (opsional)',
    ],
    'messages' => [
        'success' => [
            'create' => 'Jadwal berhasil ditambahkan.',
            'update' => 'Jadwal berhasil diubah.',
            'delete' => 'Jadwal berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan jadwal.',
            'update' => 'Gagal merubah jadwal.',
            'delete' => 'Gagal menghapus jadwal.',
            'not_found' => 'Jadwal tidak ditemukan.',
        ],
    ]
];
