<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kbb extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kbb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];
}
