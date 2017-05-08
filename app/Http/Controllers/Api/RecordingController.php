<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateRecordingRequest;
use App\Http\Requests\UpdateRecordingRequest;
use App\Repositories\RecordingRepository;
use App\Traits\SendsApiResponse;

class RecordingController extends BaseController {

    use SendsApiResponse;

    /**
     * @var RecordingRepository
     */
    private $recordingRepository;

    /**
     * ApiCardController constructor.
     * @param RecordingRepository $recordingRepository
     */
    public function __construct(RecordingRepository $recordingRepository)
    {
        $this->recordingRepository = $recordingRepository;
    }

    /**
     * Create a new building insyance
     * @param CreateRecordingRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateRecordingRequest $request)
    {
        $recording = $this->recordingRepository->create($request->only([
            'building_id', 'condition_id', 'status_id', 'comment'
        ]));

        return $this->sendResponse($recording, "Recording Successfully Created");
    }

    /**
     * Update a building
     *
     * @param UpdateRecordingRequest $request
     * @param $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateRecordingRequest $request, $id)
    {
        $recording = $this->recordingRepository->query()->findOrFail($id);
        $recording->building_id = $request->building_id;
        $recording->condition_id = $request->condition_id;
        $recording->status_id = $request->status_id;
        $recording->comment = $request->comment;

        $recording->save();

        return $this->sendResponse($recording, "Recording Successfully Updated");
    }

}
