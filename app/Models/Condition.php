<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{

    protected $guarded = [];

    /**
     * Buildings with this condition recorded against them
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }
}
