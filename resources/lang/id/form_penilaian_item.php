<?php

return [
    '_' => 'Form Penilaian Item',
    'fields' => [
        'nama' => 'Nama Item',
        'min' => 'Nilai Minimum',
        'max' => 'Nilai Maksimum',
        'isian_text' => 'Opsi Isian Text',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama item',
        'min' => 'Nilai minimum',
        'max' => 'Nilai maksimum',
    ],
    'messages' => [
        'success' => [
            'create' => 'Form Penilaian Item berhasil ditambahkan.',
            'update' => 'Form Penilaian Item berhasil diubah.',
            'delete' => 'Form Penilaian Item berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan form penilaian item.',
            'update' => 'Gagal merubah form penilaian item.',
            'delete' => 'Gagal menghapus form penilaian item.',
            'not_found' => 'Form Penilaian Item tidak ditemukan.',
        ],
    ]
];
