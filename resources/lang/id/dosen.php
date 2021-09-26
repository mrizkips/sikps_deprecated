<?php

return [
    '_' => 'Dosen',
    'fields' => [
        'nama' => 'Nama Dosen',
        'email' => 'Email',
        'nidn' => 'NIDN',
        'no_hp' => 'No. HP',
        'jen_kel' => 'Jenis Kelamin',
        'keahlian' => 'Keahlian',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama dosen',
        'email' => 'Masukkan alamat email',
        'nidn' => 'Masukkan NIDN',
        'no_hp' => 'Masukkan No. HP',
        'jen_kel' => 'Pilih Jenis Kelamin',
        'keahlian' => 'Masukkan Keahlian (opsional)',
        'password' => 'Masukkan Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'messages' => [
        'success' => [
            'create' => 'Dosen berhasil ditambahkan.',
            'update' => 'Dosen berhasil diubah.',
            'delete' => 'Dosen berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan dosen.',
            'update' => 'Gagal merubah dosen.',
            'delete' => 'Gagal menghapus dosen.',
            'not_found' => 'Dosen tidak ditemukan.',
        ],
    ]
];
