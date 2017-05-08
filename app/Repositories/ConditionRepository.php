<?php

namespace App\Repositories;

use App\Models\Condition;

class ConditionRepository extends BaseRepository
{
    public function __construct(Condition $condition)
    {
        $this->model = $condition;
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
            ->map(function ($condition) {
                return [
                    'text' => $condition->name,
                    'value' => $condition->id,
                ];
            });
    }
}
