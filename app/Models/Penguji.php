<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penguji extends Model
{
    const ROLE = [
        '1' => 'Penguji 1',
        '2' => 'Penguji 2',
    ];
    const IS_PENGUJI1 = 1;
    const IS_PENGUJI2 = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penguji';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dosen_id', 'pengujian_id', 'role',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujian_id', 'id');
    }
}
