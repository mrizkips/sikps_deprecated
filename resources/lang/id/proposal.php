<?php

return [
    '_' => 'Proposal',
    'fields' => [
        'judul' => 'Judul',
        'jenis' => 'Jenis',
        'dokumen' => 'Dokumen Proposal',
        'pendaftaran_id' => 'Periode Pendaftaran',
        'tempat_kp' => 'Tempat KP',
    ],
    'placeholders' => [
        'judul' => 'Masukkan judul',
        'jenis' => 'Pilih jenis',
        'dokumen' => 'Pilih file',
        'pendaftaran_id' => 'Pilih periode pendaftaran',
        'tempat_kp' => 'Masukkan tempat kerja praktek',
    ],
    'messages' => [
        'success' => [
            'create' => 'Proposal berhasil ditambahkan.',
            'update' => 'Proposal berhasil diubah.',
            'delete' => 'Proposal berhasil dihapus.',
            'approve' => 'Proposal berhasil disetujui.',
            'disapprove' => 'Proposal berhasil ditolak.',
            'assign' => 'Dosen pembimbing berhasil ditambahkan',
        ],
        'errors' => [
            'create' => 'Gagal menambahkan proposal.',
            'update' => 'Gagal merubah proposal.',
            'delete' => 'Gagal menghapus proposal.',
            'not_found' => 'Proposal tidak ditemukan.',
            'expired' => 'Sudah melewati batas waktu pendaftaran.',
            'approved' => 'Proposal yang sudah disetujui tidak bisa dihapus.',
            'approve' => 'Proposal gagal disetujui.',
            'disapprove' => 'Proposal gagal ditolak.',
            'assign' => 'Gagal menambahkan dosen pembimbing.',
        ],
    ]
];
