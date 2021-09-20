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
        'judul', 'jenis', 'awal', 'akhir',
    ];
}
