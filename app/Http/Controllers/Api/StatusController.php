<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateConditionRequest;
use App\Http\Requests\UpdateConditionRequest;
use App\Repositories\ConditionRepository;
use App\Repositories\StatusRepository;
use App\Traits\SendsApiResponse;

class StatusController extends BaseController {

    use SendsApiResponse;
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * StatusController constructor.
     * @param StatusRepository $statusRepository
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->middleware('userIsAdmin');
        $this->statusRepository = $statusRepository;
    }

    /**
     * Create a new status instance
     *
     * @param CreateConditionRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateConditionRequest $request)
    {
        $status = $this->statusRepository->create($request->only([
            'name', 'score'
        ]));

        return $this->sendResponse($status, "Status Successfully Created");
    }

    /**
     * Update a status
     *
     * @param UpdateConditionRequest $request
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateConditionRequest $request, $id)
    {
        $status = $this->statusRepository->update($request->only([
            'name', 'score'
        ]), $id);

        return $this->sendResponse($status, "Status Successfully Updated");
    }

}
