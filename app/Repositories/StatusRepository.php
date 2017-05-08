<?php

namespace App\Repositories;

use App\Models\Status;

class StatusRepository extends BaseRepository
{
    public function __construct(Status $status)
    {
        $this->model = $status;
    }

    /**
     * Formatting array for use in select lists
     *
     * @return \Illuminate\Support\Collection
     */
    public function formatSelectList()
    {
        return $this->model->all()
            // Needed to present the data in the correct format for Vue.js to
            // create select options
            ->map(function ($status) {
                return [
                    'text' => $status->name,
                    'value' => $status->id,
                ];
            });
    }
}