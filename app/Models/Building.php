<?php

namespace App\Models;

use App\Contracts\Mediable;
use Illuminate\Database\Eloquent\Model;

class Building extends Model implements Mediable
{
    protected $guarded = [];

    /**
     * Eager load these relationships
     *
     * @var array
     */
    protected $with = ['images', 'categories'];

    /**
     * The recordings against this building
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }

    /**
     * The categories of this building
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Documents associated with this structure
     *
     * @return mixed
     */
    public function documents()
    {
        return $this->manyMedia()->where('attachable_relationship', 'documents');
    }

    /**
     * Images associated with this building
     *
     * @return mixed
     */
    public function images()
    {
        return $this->manyMedia()->where('attachable_relationship', 'images');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function manyMedia()
    {
        return $this->morphMany(Media::class, 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function oneMedia()
    {
        return $this->morphOne(Media::class, 'attachable');
    }
}
