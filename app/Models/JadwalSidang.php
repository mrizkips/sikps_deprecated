<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jadwal_sidang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pendaftaran_id', 'tanggal', 'mulai', 'selesai', 'catatan',
    ];

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
     * Scope query untuk jadwal yang aktif.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where([
            ['tanggal', '=', today()],
            ['mulai', '<=', now()->toTimeString()],
            ['selesai', '>=', now()->toTimeString()]
        ]);
    }
}
