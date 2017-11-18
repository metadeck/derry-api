<?php

namespace App\Repositories;

use App\Models\Business;
use DB;

class BusinessRepository extends BaseRepository
{
    public function __construct(Business $business)
    {
        $this->model = $business;
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
     * Return a list of businesses filtered by distance
     *
     * @param $latitude
     * @param $longitude
     * @param $distance
     * @param int $paginate
     * @return mixed
     */
    public function getNearby($latitude, $longitude, $distance, $paginate = 20)
    {
        $businesses = $this->model
            ->select(DB::raw("businesses.*, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->simplePaginate($paginate);
        return $businesses;
    }

    /**
     * Get all business locations in a google maps compatible format
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllLocations()
    {
        return $this->model->all()->map(function($business){
            return (object) [
                "lat" => floatval($business->latitude),
                "lng" => floatval($business->longitude),
                "info" => $business->name
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
            ->map(function ($business) {
                return [
                    'text' => $business->name,
                    'value' => $business->id,
                ];
            });
    }
}
