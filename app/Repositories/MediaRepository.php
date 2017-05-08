<?php

namespace App\Repositories;

use App\Models\Media;
use Schema;

class MediaRepository extends BaseRepository
{
    /**
     * PlaceRepository constructor.
     * @param Media $model
     */
    public function __construct(Media $model)
    {
        $this->model = $model;
    }

}