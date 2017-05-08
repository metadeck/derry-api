<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    /**
     * Buildings with this status recorded against them
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function buildings()
    {
        return $this->hasManyThrough(Building::class, Recording::class);
    }

    /**
     * Recordings associated with this status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }
}
