<?php

return [
    '_' => 'Pendaftaran',
    'fields' => [
        'judul' => 'Judul',
        'jenis' => 'Jenis',
        'awal' => 'Tanggal Pembuka',
        'akhir' => 'Tanggal Penutup',
        'tanggal_kontrak' => 'Tanggal Kontrak',
    ],
    'placeholders' => [
        'judul' => 'Masukkan judul',
        'jenis' => 'Pilih jenis',
        'awal' => 'Masukkan tanggal',
        'akhir' => 'Masukkan tanggal',
        'tanggal_kontrak' => 'Masukkan tanggal',
    ],
    'messages' => [
        'success' => [
            'create' => 'Pendaftaran berhasil ditambahkan.',
            'update' => 'Pendaftaran berhasil diubah.',
            'delete' => 'Pendaftaran berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan dosen.',
            'update' => 'Gagal merubah dosen.',
            'delete' => 'Gagal menghapus dosen.',
            'not_found' => 'Pendaftaran tidak ditemukan.',
        ],
    ]
];
