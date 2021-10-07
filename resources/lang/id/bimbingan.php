<?php

return [
    '_' => 'Bimbingan',
    'fields' => [
        'jadwal_id' => 'Jadwal Bimbingan',
        'proposal_id' => 'Proposal',
        'catatan' => 'Catatan',
        'pin' => 'Pin',
    ],
    'placeholders' => [
        'jadwal_id' => 'Pilih Jadwal Bimbingan',
        'proposal_id' => 'Pilih Proposal',
        'catatan' => 'Catatan',
        'pin' => 'Pin Absen',
    ],
    'messages' => [
        'success' => [
            'create' => 'Bimbingan berhasil ditambahkan.',
            'update' => 'Bimbingan berhasil diubah.',
            'delete' => 'Bimbingan berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan bimbingan.',
            'update' => 'Gagal merubah bimbingan.',
            'delete' => 'Gagal menghapus bimbingan.',
            'not_found' => 'Bimbingan tidak ditemukan.',
            'pin' => 'Pin tidak sesuai.',
        ],
    ]
];
