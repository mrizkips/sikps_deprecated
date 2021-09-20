<?php

return [
    '_' => 'Petugas',
    'fields' => [
        'nama' => 'Nama Petugas',
        'email' => 'Email',
        'nip' => 'NIP',
        'no_hp' => 'No. HP',
        'jen_kel' => 'Jenis Kelamin',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama dosen',
        'email' => 'Masukkan alamat email',
        'nip' => 'Masukkan NIP',
        'no_hp' => 'Masukkan No. HP',
        'jen_kel' => 'Pilih Jenis Kelamin',
        'password' => 'Masukkan Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'messages' => [
        'success' => [
            'create' => 'Petugas berhasil ditambahkan.',
            'update' => 'Petugas berhasil diubah.',
            'delete' => 'Petugas berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan dosen.',
            'update' => 'Gagal merubah dosen.',
            'delete' => 'Gagal menghapus dosen.',
            'not_found' => 'Petugas tidak ditemukan.',
        ],
    ]
];
