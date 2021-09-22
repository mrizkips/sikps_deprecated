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
        'judul', 'jenis', 'mahasiswa_id', 'dokumen', 'pendaftaran_id', 'kbb_id', 'tanggal_kontrak', 'dosen_id',
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
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kbb()
    {
        return $this->belongsTo(Kbb::class, 'kbb_id', 'id');
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
}
