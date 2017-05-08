<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Repositories\BuildingRepository;
use App\Traits\SendsApiResponse;

class BuildingController extends BaseController {

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
     * Create a new building insyance
     * @param CreateBuildingRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateBuildingRequest $request)
    {
        $building = $this->buildingRepository->create($request->only([
            'name', 'address_1', 'address_2', 'town_city', 'postal_code', 'county', 'latitude', 'longitude'
        ]));

        $building->categories()->sync($request->categories);

        return $this->sendResponse($building, "Building Successfully Created");
    }

    /**
     * Update a building
     *
     * @param UpdateBuildingRequest $request
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateBuildingRequest $request, $id)
    {
        $building = $this->buildingRepository->query()->findOrFail($id);
        $building->name = $request->name;
        $building->address_1 = $request->address_1;
        $building->address_2 = $request->address_2;
        $building->town_city = $request->town_city;
        $building->postal_code = $request->postal_code;
        $building->county = $request->county;
        $building->latitude = $request->latitude;
        $building->longitude = $request->longitude;

        $building->save();
        $building->categories()->sync($request->categories);

        return $this->sendResponse($building, "Building Successfully Updated");
    }

}
