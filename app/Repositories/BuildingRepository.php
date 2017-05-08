<?php

namespace App\Repositories;

use App\Models\Building;

class BuildingRepository extends BaseRepository
{
    public function __construct(Building $building)
    {
        $this->model = $building;
    }

    public function search($text = null, $categories = null, $conditions = null, $status = null)
    {
        $query = $this->query();

        if($text){
            $query->where('name', 'like', '%' . $text . '%');
        }
        if($categories){
            $query->categories()->whereIn('id', $categories);
        }

        return $query->paginate(20);
    }

    /**
     * Get all building locations in a google maps compatible format
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllLocations()
    {
        return $this->model->all()->map(function($building){
            return (object) [
                "lat" => floatval($building->latitude),
                "lng" => floatval($building->longitude),
                "info" => $building->name
            ];
        });
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
            ->map(function ($building) {
                return [
                    'text' => $building->name,
                    'value' => $building->id,
                ];
            });
    }
}
