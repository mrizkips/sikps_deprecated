<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    const IS_SKRIPSI = 1;
    const IS_PRASKRIPSI = 2;
    const IS_KP = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sidang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis', 'proposal_id', 'pendaftaran_id', 'laporan', 'penilaian_kp', 'catatan',
    ];

    /**
     * Get a certain records.
     */
    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }
}
