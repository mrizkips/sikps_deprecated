<?php

return [
    '_' => 'Penguji',
    'fields' => [
        'dosen_id' => 'Dosen Penguji',
        'role' => 'Role Penguji'
    ],
    'placeholders' => [
        'dosen_id' => 'Pilih Dosen Penguji',
        'role' => 'Pilih Role Penguji'
    ],
    'messages' => [
        'success' => [
            'create' => 'Penguji berhasil ditambahkan.',
            'update' => 'Penguji berhasil diubah.',
            'delete' => 'Penguji berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan penguji.',
            'update' => 'Gagal merubah penguji.',
            'delete' => 'Gagal menghapus penguji.',
            'not_found' => 'Penguji tidak ditemukan.',
            'is_pembimbing' => 'Dosen penguji tidak boleh sama dengan dosen pembimbing.',
            'is_full' => 'Dosen penguji sudah full.',
        ],
    ]
];
