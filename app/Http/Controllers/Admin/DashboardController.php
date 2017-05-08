<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BuildingRepository;
use App\Repositories\RecordingRepository;
use App\Repositories\UserRepository;
use Auth;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var BuildingRepository
     */
    private $buildingRepository;
    /**
     * @var RecordingRepository
     */
    private $recordingRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param BuildingRepository $buildingRepository
     * @param RecordingRepository $recordingRepository
     */
    public function __construct(
        UserRepository $userRepository,
        BuildingRepository $buildingRepository,
        RecordingRepository $recordingRepository
    )
    {
        $this->middleware('userIsAdmin');
        $this->userRepository = $userRepository;
        $this->buildingRepository = $buildingRepository;
        $this->recordingRepository = $recordingRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard', [
            'user_count' => $this->userRepository->appUsers()->count(),
            'buildings' => $this->buildingRepository->getAllLocations(),
            'recording_count' => $this->recordingRepository->query()->count(),
            'app_users' => $this->userRepository->appUsers()->latest()->take(10)->get(),
            'recordings' => $this->recordingRepository->with('status,condition')->query()->latest()->take(10)->get()
        ]);
    }
}
