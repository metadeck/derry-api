<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\RecordingRepository;
use App\Traits\SendsApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecordingsByDaysController extends Controller
{
    use SendsApiResponse;
    /**
     * @var RecordingRepository
     */
    private $recordingRepository;

    /**
     * CourseController constructor.
     * @param RecordingRepository $recordingRepository
     */
    public function __construct(RecordingRepository $recordingRepository)
    {
        $this->middleware('userIsAdmin');
        $this->recordingRepository = $recordingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $recordings = $this->recordingRepository->getAllForPreviousDays($request->num_days);
        return $this->sendResponse($recordings, Response::HTTP_OK);
    }
}
