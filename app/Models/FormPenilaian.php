<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPenilaian extends Model
{
    /**
     * Constants.
     */
    const IS_ADMIN = 1;
    const IS_PENGUJI1 = 2;
    const IS_PENGUJI2 = 3;
    const IS_PEMBIMBING = 4;
    const PENILAI = [
        '1' => 'Prodi',
        '2' => 'Penguji 1',
        '3' => 'Penguji 2',
        '4' => 'Pembimbing',
    ];

    const IS_SIDANG = 1;
    const IS_PRA_SIDANG = 2;
    const IS_KP = 3;
    const JENIS = [
        '1' => 'Sidang Skripsi',
        '2' => 'Pra-Sidang Skripsi',
        '3' => 'Sidang KP',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'jenis', 'penilai',
    ];

    /**
     * Get relationship on form_penilaian_item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function form_penilaian_item()
    {
        return $this->hasMany(FormPenilaianItem::class);
    }
}
