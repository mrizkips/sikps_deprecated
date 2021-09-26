<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendaftaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul', 'jenis', 'awal', 'akhir', 'tanggal_kontrak',
    ];

    /**
     * Scope query untuk pendaftaran yang aktif.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where([
            ['awal', '<=', today()],
            ['akhir', '>=', today()]
        ]);
    }

    /**
     * Scope query untuk pendaftaran proposal.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProposal($query)
    {
        return $query->where('jenis', '1');
    }

    /**
     * Scope query untuk pendaftaran sidang.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSidang($query)
    {
        return $query->where('jenis', '2');
    }
}
