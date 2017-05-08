<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    private $baseUrl = "https://s3-eu-west-1.amazonaws.com/jamapp-media";

    protected $guarded = [];

    protected $appends = ['full_media_path'];

    /**
     * A media element can be attached to various models, i.e. a user to save its avatar
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }


    /**
     * Utility function to provide full media url
     * @return mixed
     */
    public function getFullMediaPathAttribute()
    {
        return $this->baseUrl . "/" . $this->filename;
    }
}
