<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
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
            ->map(function ($category) {
                return [
                    'text' => $category->name,
                    'value' => $category->id,
                ];
            });
    }

    /**
     * Formatting array for use in select2 lists
     *
     * @return \Illuminate\Support\Collection
     */
    public function formatSelect2List()
    {
        return $this->model->all()
            // Needed to present the data in the correct format for Vue.js to
            // create select options
            ->map(function ($category) {
                return [
                    'text' => $category->name,
                    'id' => $category->id,
                ];
            });
    }
}
