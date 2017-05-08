<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * The buildings belonging to this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function buildings()
    {
        return $this->belongsToMany(Building::class);
    }
}
