<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BuildingRepository;
use App\Traits\SendsApiResponse;
use Illuminate\Http\Request;

class NearbyBuildingsController extends BaseController {

    use SendsApiResponse;

    /**
     * @var BuildingRepository
     */
    private $buildingRepository;

    /**
     * ApiCardController constructor.
     * @param BuildingRepository $buildingRepository
     */
    public function __construct(BuildingRepository $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * Show a listing of nearby places
     *
     * @param Request $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function index(Request $request)
    {
        //Fake some geo data for now
        $buildings = $this->buildingRepository->getNearby(54.879391, -6.350279, 5, 20);
        return $this->sendResponse($buildings, 'Buildings retrieved successfully');
    }

}
