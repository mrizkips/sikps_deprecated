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
        'pendaftaran_id', 'sidang_id', 'tanggal', 'mulai', 'selesai', 'ruangan', 'catatan',
    ];

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
     * Get pendaftaran on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }

    /**
     * Get penguji on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penguji()
    {
        return $this->hasMany(Penguji::class);
    }
}
