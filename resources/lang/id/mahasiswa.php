<?php

return [
    '_' => 'Mahasiswa',
    'fields' => [
        'nama' => 'Nama Mahasiswa',
        'email' => 'Email',
        'nim' => 'NIM',
        'no_hp' => 'No. HP',
        'jen_kel' => 'Jenis Kelamin',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama mahasiswa',
        'email' => 'Masukkan alamat email',
        'nim' => 'Masukkan NIM',
        'no_hp' => 'Masukkan No. HP',
        'jen_kel' => 'Pilih Jenis Kelamin',
        'password' => 'Masukkan Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'messages' => [
        'success' => [
            'create' => 'Mahasiswa berhasil ditambahkan.',
            'update' => 'Mahasiswa berhasil diubah.',
            'delete' => 'Mahasiswa berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan mahasiswa.',
            'update' => 'Gagal merubah mahasiswa.',
            'delete' => 'Gagal menghapus mahasiswa.',
            'not_found' => 'Mahasiswa tidak ditemukan.',
        ],
    ]
];
