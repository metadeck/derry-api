<?php

namespace App\Repositories;

use App\Models\Building;
use DB;

class BuildingRepository extends BaseRepository
{
    public function __construct(Building $building)
    {
        $this->model = $building;
    }

    public function search($text = null, $categories = null, $conditions = null)
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
     * Return a list of buildings filtered by distance
     *
     * @param $latitude
     * @param $longitude
     * @param $distance
     * @param int $paginate
     * @return mixed
     */
    public function getNearby($latitude, $longitude, $distance, $paginate = 20)
    {
        $buildings = $this->model
            ->select(DB::raw("buildings.*, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->simplePaginate($paginate);
        return $buildings;
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
        return $this->model->orderBy('name')->get()
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
