<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'penilaian_id', 'form_penilaian_item_id', 'nilai', 'keterangan',
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'penilaian_id', 'id');
    }

    public function form_penilaian_item()
    {
        return $this->belongsTo(FormPenilaianItem::class, 'form_penilaian_item_id', 'id');
    }
}
