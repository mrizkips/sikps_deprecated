<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
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
        'proposal_id', 'dokumen', 'pendaftaran_id',
    ];

    /**
     * Get a certain records.
     */
    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }
}
