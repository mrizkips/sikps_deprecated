<?php

return [
    '_' => 'Pengujian',
    'fields' => [
        'pendaftaran_id' => 'Periode Pendaftaran' ,
        'sidang_id' => 'Pengajuan Sidang',
        'tanggal' => 'Tanggal',
        'mulai' => 'Jam Mulai',
        'selesai' => 'Jam Selesai',
        'ruangan' => 'Ruangan',
        'catatan' => 'Catatan Penguji',
    ],
    'placeholders' => [
        'pendaftaran_id' => 'Pilih Periode Pendaftaran',
        'sidang_id' => 'Pilih Pengajuan Sidang',
        'tanggal' => 'Masukkan Tanggal Sidang',
        'mulai' => 'Masukkan Jam Mulai',
        'selesai' => 'Masukkan Jam Selesai',
        'ruangan' => 'Masukkan Ruangan Sidang',
        'catatan' => 'Masukkan Catatan Penguji',
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
            'is_existed' => 'Pengujian sudah ditambahkan di periode pendaftaran yang sama.',
        ],
    ]
];
