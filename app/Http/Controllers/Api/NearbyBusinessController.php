<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BusinessRepository;
use App\Traits\SendsApiResponse;
use Illuminate\Http\Request;

class NearbyBusinessController extends BaseController {

    use SendsApiResponse;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
    * @param BusinessRepository $businessRepository
     */
    public function __construct(BusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
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
        $businesss = $this->businessRepository->getNearby(54.879391, -6.350279, 5, 20);
        return $this->sendResponse($businesss, 'Businesses retrieved successfully');
    }

}
