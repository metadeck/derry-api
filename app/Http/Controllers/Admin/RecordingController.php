<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BuildingRepository;
use App\Repositories\ConditionRepository;
use App\Repositories\RecordingRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordingController extends Controller
{
    /**
     * @var RecordingRepository
     */
    private $recordingRepository;
    /**
     * @var StatusRepository
     */
    private $statusRepository;
    /**
     * @var ConditionRepository
     */
    private $conditionRepository;
    /**
     * @var BuildingRepository
     */
    private $buildingRepository;

    /**
     * CourseController constructor.
     * @param RecordingRepository $recordingRepository
     * @param BuildingRepository $buildingRepository
     * @param StatusRepository $statusRepository
     * @param ConditionRepository $conditionRepository
     */
    public function __construct(
        RecordingRepository $recordingRepository,
        BuildingRepository $buildingRepository,
        StatusRepository $statusRepository,
        ConditionRepository $conditionRepository)
    {
        $this->middleware('userIsAdmin');
        $this->statusRepository = $statusRepository;
        $this->conditionRepository = $conditionRepository;
        $this->recordingRepository = $recordingRepository;
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->has('conditions') || $request->has('statuses')){
            $query = $this->recordingRepository
                ->with('status,condition')
                ->query();

            if($request->has('conditions')){
                $query->whereIn('condition_id', explode(',', $request->conditions));
            }
            if($request->has('statuses')){
                $query->whereIn('status_id', explode(',', $request->statuses));
            }
            $query->orderBy('created_at', 'DESC');

            $recordings = $query->paginate(20);
        } else {
            $recordings = $this->recordingRepository
                ->with('status,condition')
                ->query()
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        }

        return view('admin.recordings.index', [
            'recordings' => $recordings,
            'statuses' => $this->statusRepository->formatSelectList(),
            'conditions' => $this->conditionRepository->formatSelectList(),
        ]);
    }

    public function create()
    {
        return view('admin.recordings.create', [
            'buildings' => $this->buildingRepository->formatSelectList(),
            'statuses' => $this->statusRepository->formatSelectList(),
            'conditions' => $this->conditionRepository->formatSelectList()
        ]);
    }

}