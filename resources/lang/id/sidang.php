<?php

return [
    '_' => 'Sidang',
    'fields' => [
        'jenis' => 'Jenis Sidang',
        'proposal_id' => 'Proposal',
        'pendaftaran_id' => 'Periode Pendaftaran',
        'laporan' => 'File Laporan',
        'penilaian_kp' => 'Form Penilaian KP',
        'catatan' => 'Catatan',
    ],
    'placeholders' => [
        'jenis' => 'Pilih jenis sidang',
        'proposal_id' => 'Pilih proposal',
        'pendaftaran_id' => 'Pilih periode pendaftaran',
        'laporan' => 'Upload file laporan',
        'penilaian_kp' => 'Upload form penilaian KP',
        'catatan' => 'Catatan (Opsional)',
    ],
    'messages' => [
        'success' => [
            'create' => 'Sidang berhasil ditambahkan.',
            'update' => 'Sidang berhasil diubah.',
            'delete' => 'Sidang berhasil dihapus.',
            'approve' => 'Sidang berhasil disetujui.',
            'disapprove' => 'Sidang berhasil ditolak.',
            'assign' => 'Dosen pembimbing berhasil ditambahkan',
        ],
        'errors' => [
            'create' => 'Gagal menambahkan sidang.',
            'update' => 'Gagal merubah sidang.',
            'delete' => 'Gagal menghapus sidang.',
            'not_found' => 'Sidang tidak ditemukan.',
            'expired' => 'Sudah melewati batas waktu pendaftaran.',
            'duplicate' => 'Sudah pernah mendaftar sidang dengan judul serupa di periode yang sama.',
            'invalid_jenis' => 'Jenis sidang dan jenis proposal tidak sesuai.',
            'approve' => 'Sidang gagal disetujui.',
            'approved' => 'Sidang yang sudah disetujui tidak bisa dihapus.',
            'disapprove' => 'Sidang gagal ditolak.',
            'assign' => 'Gagal menambahkan dosen penilai.',
        ],
    ]
];
