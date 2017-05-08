<?php

namespace App\Repositories;

use App\Models\Recording;
use Carbon\Carbon;

class RecordingRepository extends BaseRepository
{
    public function __construct(Recording $recording)
    {
        $this->model = $recording;
    }

    /**
     * Get all usages for the previous number of given days
     * Formatted for d3 charts
     *
     * @param $num_days
     */
    public function getAllForPreviousDays($num_days)
    {
        return $this->model->where('created_at', '>=', Carbon::now()->subDays($num_days))
            ->orderBy('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('d-m'); // grouping by years
            })->map(function ($item, $key){
                //return $item->count();
                return ["label" => $key, "value" => $item->count()];
            })
            //remove keys from collection
            ->values();
    }
}
