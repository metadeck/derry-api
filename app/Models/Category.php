<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * The businesses belonging to this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function businesses()
    {
        return $this->belongsToMany(Business::class);
    }

    /**
     * The parent category (if exists)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * The child categories
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
