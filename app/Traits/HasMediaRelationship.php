<?php
/**
 * Created by PhpStorm.
 * User: declanmcdonough
 * Date: 05/02/2017
 * Time: 19:00
 */

namespace App\Traits;

use App\Models\Media;

trait HasMediaRelationship
{
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