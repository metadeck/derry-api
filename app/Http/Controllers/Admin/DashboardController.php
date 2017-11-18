<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BusinessRepository;
use App\Repositories\UserRepository;
use Auth;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param BusinessRepository $businessRepository
     */
    public function __construct(
        UserRepository $userRepository,
        BusinessRepository $businessRepository
    )
    {
        $this->middleware('userIsAdmin');
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard', [
            'user_count' => $this->userRepository->users()->count(),
            'businesses' => $this->businessRepository->getAllLocations(),
        ]);
    }
}
