<?php

namespace App\Models;

use App\Traits\HasMediaRelationship;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    use HasMediaRelationship;
    
    protected $guarded = [];

    /**
     * Eager load these relationships
     *
     * @var array
     */
    protected $with = ['images', 'categories'];

    /**
     * The categories of this Business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Documents associated with this Business
     *
     * @return mixed
     */
    public function documents()
    {
        return $this->manyMedia()->where('attachable_relationship', 'documents');
    }

    /**
     * Images associated with this Business
     *
     * @return mixed
     */
    public function images()
    {
        return $this->manyMedia()->where('attachable_relationship', 'images');
    }
}
