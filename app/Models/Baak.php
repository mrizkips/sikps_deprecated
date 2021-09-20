<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'baak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip', 'user_id', 'no_hp', 'jen_kel',
    ];

    /**
     * Get the user on a certain records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
