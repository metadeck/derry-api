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
     * Get all the top level models
     */
    public function topLevelCategories()
    {
        return $this->model->whereNull('parent_id')->orderBy('name')->paginate(20);
    }

    /**
     * Get all child categories for a given id
     */
    public function childCategoriesFor($categoryId)
    {
        return $this->model->find($categoryId)->children->paginate(20);
    }

    public function businessesByCategoryIds($categoryIds)
    {
        return $this->model->with('businesses')->find($categoryIds)
            ->flatMap(function($category){
                return $category->businesses;
            })
            ->unique('id');
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
