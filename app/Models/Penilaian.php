<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pengujian_id', 'form_penilaian_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujian_id', 'id');
    }

    public function form_penilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'form_penilaian_id', 'id');
    }

    public function penilaian_item()
    {
        return $this->hasMany(PenilaianItem::class);
    }
}
