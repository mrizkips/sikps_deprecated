<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe',
    ];

    /**
     * Get all of the owning statusable models.
     */
    public function statusable()
    {
        return $this->morphTo();
    }
}
