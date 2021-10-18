<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPenilaianItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_penilaian_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_penilaian_id', 'nama', 'min', 'max',
    ];

    /**
     * Get a certain record on form_penilaian.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form_penilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'form_penilaian_id', 'id');
    }
}
