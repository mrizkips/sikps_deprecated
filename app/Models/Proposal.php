<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Proposal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proposal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul', 'jenis', 'mahasiswa_id', 'dokumen', 'pendaftaran_id', 'dosen_id', 'tempat_kp',
    ];

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id')->withDefault(['user' => ['nama' => '-']]);
    }

    /**
     * Get a certain records.
     */
    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    /**
     * Get a certain records.
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }

    /**
     * Scope query untuk kerja praktek.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKp($query)
    {
        return $query->where('jenis', '2');
    }

    /**
     * Scope query untuk skripsi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSkripsi($query)
    {
        return $query->where('jenis', '1');
    }

    /**
     * Scope query untuk status diterima.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('dosen_id', '!=', null);
    }

    /**
     * Get a certain records.
     */
    public function sidang()
    {
        return $this->hasOne(Sidang::class);
    }
}
