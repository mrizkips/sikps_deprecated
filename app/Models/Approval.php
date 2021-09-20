<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe', 'catatan', 'role_id', 'status_id',
    ];

    /**
     * Get a certain records.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Get a certain records.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
