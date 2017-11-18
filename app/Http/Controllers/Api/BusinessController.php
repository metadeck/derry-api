<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Repositories\BusinessRepository;
use App\Traits\SendsApiResponse;

class BusinessController extends BaseController {

    use SendsApiResponse;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * ApiCardController constructor.
     * @param BusinessRepository $businessRepository
     */
    public function __construct(BusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }

    /**
    * Get a list of businesses.
    * GET /businesses
    * @param int $id  The test of a User
    *
    * @return Response
    */
    public function index()
    {
        $businesses = $this->businessRepository->simplePaginate();
        return $this->sendCollectionResponse($businesses, "Businesses Successfully Retrieved");
    }

    /**
     * Create a new business instance
     * @param CreateBusinessRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateBusinessRequest $request)
    {
        $business = $this->businessRepository->create($request->only([
            'name', 'address_1', 'address_2', 'town_city', 'postal_code', 'county', 'latitude', 'longitude'
        ]));

        $business->categories()->sync($request->categories);

        return $this->sendResponse($business, "Business Successfully Created");
    }

    /**
     * Update a business
     *
     * @param UpdateBusinessRequest $request
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateBusinessRequest $request, $id)
    {
        $business = $this->businessRepository->query()->findOrFail($id);
        $business->name = $request->name;
        $business->address_1 = $request->address_1;
        $business->address_2 = $request->address_2;
        $business->town_city = $request->town_city;
        $business->postal_code = $request->postal_code;
        $business->county = $request->county;
        $business->latitude = $request->latitude;
        $business->longitude = $request->longitude;

        $business->save();
        $business->categories()->sync($request->categories);

        return $this->sendResponse($business, "Business Successfully Updated");
    }

}
