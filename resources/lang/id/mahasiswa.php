<?php

return [
    '_' => 'Mahasiswa',
    'fields' => [
        'nama' => 'Nama Mahasiswa',
        'email' => 'Email',
        'nim' => 'NIM',
        'kbb_id' => 'KBB',
        'jurusan_id' => 'Jurusan',
        'alamat' => 'Alamat',
        'no_hp' => 'No. Handphone',
        'jen_kel' => 'Jenis Kelamin',
        'tempat_lahir' => 'Tempat Lahir',
        'tanggal_lahir' => 'Tanggal Lahir',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama mahasiswa',
        'email' => 'Masukkan alamat email',
        'nim' => 'Masukkan NIM',
        'kbb_id' => 'Pilih KBB',
        'jurusan_id' => 'Pilih Jurusan',
        'alamat' => 'Masukkan Alamat',
        'no_hp' => 'No. Handphone',
        'jen_kel' => 'Pilih Jenis Kelamin',
        'tempat_lahir' => 'Masukkan Tempat Lahir',
        'tanggal_lahir' => 'Masukkan Tanggal Lahir',
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
