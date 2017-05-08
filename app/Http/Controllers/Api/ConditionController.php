<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateConditionRequest;
use App\Http\Requests\UpdateConditionRequest;
use App\Repositories\ConditionRepository;
use App\Traits\SendsApiResponse;

class ConditionController extends BaseController {

    use SendsApiResponse;
    /**
     * @var ConditionRepository
     */
    private $conditionRepository;

    /**
     * ConditionController constructor.
     * @param ConditionRepository $conditionRepository
     */
    public function __construct(ConditionRepository $conditionRepository)
    {
        $this->middleware('userIsAdmin');
        $this->conditionRepository = $conditionRepository;
    }

    /**
     * Create a new condition instance
     *
     * @param CreateConditionRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateConditionRequest $request)
    {
        $category = $this->conditionRepository->create($request->only([
            'name', 'score'
        ]));

        return $this->sendResponse($category, "Condition Successfully Created");
    }

    /**
     * Update a condition
     *
     * @param UpdateConditionRequest $request
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateConditionRequest $request, $id)
    {
        $category = $this->conditionRepository->update($request->only([
            'name', 'score'
        ]), $id);

        return $this->sendResponse($category, "Condition Successfully Updated");
    }

}
