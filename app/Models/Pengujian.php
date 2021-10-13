<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengujian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jadwal_sidang_id', 'sidang_id', 'dosen_id', 'nilai_ppt', 'nilai_laporan', 'nilai_aplikasi',
    ];

    /**
     * Get jadwal sidang on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal_sidang()
    {
        return $this->belongsTo(JadwalSidang::class, 'jadwal_sidang_id', 'id');
    }

    /**
     * Get sidang on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sidang()
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }

    /**
     * Get dosen on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
